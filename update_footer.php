<?php
App\Models\Setting::updateOrCreate(
    ['key' => 'shop_receipt_footer'],
    ['value' => "Terimakasih atas Kunjungan Anda !\nBarang yang sudah dibeli\ntidak dapat ditukar/dikembalikan"]
);
echo "Footer updated successfully.\n";
