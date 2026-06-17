<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Models\Setting;

#[Fillable([
    'invoice_number', 'shift_id', 'user_id', 'subtotal',
    'discount', 'tax', 'grand_total', 'payment_method',
    'amount_paid', 'change_due', 'is_synced'
])]
class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    /**
     * Generate raw text for receipt printing.
     */
    public function generateReceiptText()
    {
        $shopName = Setting::getValue('shop_name', 'BAUNTUNGPOS');
        $shopSub = Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO');
        $shopAddr = Setting::getValue('shop_address', 'Jl. Panglima Batur, Komet, Banjarbaru');
        $shopPhone = Setting::getValue('shop_phone', '081230100395');
        $footer = Setting::getValue('shop_receipt_footer', "Terimakasih atas Kunjungan Anda\nBarang yang sudah dibeli\ntidak dapat ditukar/dikembalikan");
        $chars = (int) Setting::getValue('printer_chars_per_line', '32');
        
        $separator = str_repeat('-', $chars);
        
        $out = [];
        $out[] = $this->centerText($shopName, $chars);
        $out[] = $this->centerText($shopSub, $chars);
        
        $addrLines = explode("\n", wordwrap($shopAddr, $chars, "\n"));
        foreach ($addrLines as $line) {
            $out[] = $this->centerText($line, $chars);
        }
        $out[] = $this->centerText("Telp: " . $shopPhone, $chars);
        $out[] = $separator;
        
        $tgl = \Illuminate\Support\Carbon::parse($this->created_at)->format('d-m-Y H:i');
        $kasir = substr($this->user ? $this->user->name : 'Kasir', 0, 10);
        $out[] = $this->rightAlignedLabelValue($tgl, "Ksr: " . $kasir, $chars);
        $out[] = "Struk: " . $this->invoice_number;
        $out[] = $separator;
        
        $details = $this->details()->with('product')->get();
        foreach ($details as $detail) {
            $prodName = $detail->product->name;
            $fullName = "[" . $detail->product->product_code . "] " . $prodName;
            $wrappedName = explode("\n", wordwrap($fullName, $chars, "\n", true));
            foreach ($wrappedName as $line) {
                $out[] = str_pad($line, $chars, " ");
            }
            
            $qtyPart = "  " . $detail->qty . " " . $detail->product->unit . " x " . number_format($detail->sell_price, 0, ',', '.');
            if ($detail->discount_amount > 0) {
                $qtyPart .= " (D: " . number_format($detail->discount_amount, 0, ',', '.') . ")";
            }
            $subTotalPart = number_format($detail->subtotal, 0, ',', '.');
            
            $spacesNeeded = $chars - strlen($qtyPart) - strlen($subTotalPart);
            if ($spacesNeeded < 1) $spacesNeeded = 1;
            
            $out[] = $qtyPart . str_repeat(' ', $spacesNeeded) . $subTotalPart;
        }
        
        $out[] = $separator;
        
        $out[] = $this->rightAlignedLabelValue("SUBTOTAL:", number_format($this->subtotal, 0, ',', '.'), $chars);
        if ($this->discount > 0) {
            $out[] = $this->rightAlignedLabelValue("DISKON:", "-" . number_format($this->discount, 0, ',', '.'), $chars);
        }
        $out[] = $this->rightAlignedLabelValue("TOTAL:", number_format($this->grand_total, 0, ',', '.'), $chars);
        $out[] = $this->rightAlignedLabelValue("BAYAR (" . strtoupper($this->payment_method) . "):", number_format($this->amount_paid, 0, ',', '.'), $chars);
        
        if ($this->payment_method === 'cash') {
            $out[] = $this->rightAlignedLabelValue("KEMBALI:", number_format($this->change_due, 0, ',', '.'), $chars);
        }
        
        $out[] = $separator;
        
        $footerLines = explode("\n", $footer);
        foreach ($footerLines as $fline) {
            $flineWrapped = explode("\n", wordwrap($fline, $chars, "\n", true));
            foreach ($flineWrapped as $wrapped) {
                $out[] = $this->centerText($wrapped, $chars);
            }
        }
        
        return implode("\n", $out);
    }

    private function centerText($text, $width)
    {
        $text = trim($text);
        if (strlen($text) >= $width) {
            return substr($text, 0, $width);
        }
        $padding = ($width - strlen($text)) / 2;
        return str_repeat(' ', floor($padding)) . $text . str_repeat(' ', ceil($padding));
    }

    private function rightAlignedLabelValue($label, $value, $width = 32)
    {
        $spaces = $width - strlen($label) - strlen($value);
        if ($spaces < 1) $spaces = 1;
        return $label . str_repeat(' ', $spaces) . $value;
    }
}
