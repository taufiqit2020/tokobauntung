<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Bluetooth Print app (mate.bluetoothprint) - Browser/Website Print endpoint
// The app fetches JSON from this URL to print receipts
Route::get('/print-receipt', function (\Illuminate\Http\Request $request) {
    $content = $request->query('content', '');
    
    if (empty($content)) {
        return response()->json([
            ['content' => 'Struk kosong', 'bold' => 1, 'align' => 1]
        ]);
    }
    
    // Decode the receipt text
    $text = urldecode($content);
    
    // Split text into lines and format as JSON array for Bluetooth Print app
    $lines = explode("\n", $text);
    $printData = [];
    $dividerCount = 0;
    $isFirstLine = true;
    
    foreach ($lines as $line) {
        $trimmedLine = trim($line);
        
        // Detect divider
        if (str_starts_with($trimmedLine, '-') || str_starts_with($trimmedLine, '=')) {
            $printData[] = [
                'type' => 0,
                'content' => $trimmedLine,
                'bold' => 1,
                'align' => 0,
                'format' => 0,
            ];
            $dividerCount++;
            continue;
        }
        
        if (empty($trimmedLine)) {
            $printData[] = [
                'type' => 0,
                'content' => ' ',
                'bold' => 0,
                'align' => 0,
                'format' => 0,
            ];
            continue;
        }
        
        $bold = 0;
        $align = 0;
        $format = 0;
        $content = $line; // default keep spacing
        
        if ($dividerCount == 0) {
            // Header Section: Center all
            $align = 1;
            $content = $trimmedLine; // Trim to let printer center it natively
            if ($isFirstLine) {
                $bold = 1;
                $isFirstLine = false;
            }
        } elseif ($dividerCount == 1) {
            // Transaction Info Section: Left
            $align = 0;
        } elseif ($dividerCount == 2) {
            // Item Details Section: Left
            $align = 0;
        } elseif ($dividerCount == 3) {
            // Summary Section: Left, Bold
            $align = 0;
            $bold = 1;
        } else {
            // Footer Section: Center
            $align = 1;
            $content = $trimmedLine; // Trim to let printer center it natively
        }
        
        $printData[] = [
            'type' => 0,
            'content' => $content,
            'bold' => $bold,
            'align' => $align,
            'format' => $format,
        ];
    }
    
    return response()->json($printData, 200, [], JSON_FORCE_OBJECT);
})->name('api.print-receipt');
