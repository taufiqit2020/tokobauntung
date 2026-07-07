<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('products:clean', function () {
    $this->info('Starting database products & categories cleanup...');

    $targetCategories = [
        'PLASTIK' => 'PLS',
        'SEMBAKO' => 'SMB',
        'ATK' => 'ATK',
        'ROKOK' => 'RK',
        'SNACK' => 'SNC',
        'KEBERSIHAN' => 'KBS',
        'MINUMAN' => 'MNM'
    ];

    DB::beginTransaction();
    try {
        // 1. Create target categories if they do not exist
        $categoryModels = [];
        foreach ($targetCategories as $name => $prefix) {
            $cat = \App\Models\Category::where('name', 'like', $name)->first();
            if (!$cat) {
                $cat = \App\Models\Category::create([
                    'name' => strtoupper($name),
                    'description' => "Kategori utama {$name} untuk BauntungPOS"
                ]);
            } else {
                $cat->update(['name' => strtoupper($name)]);
            }
            $categoryModels[$name] = $cat;
        }

        // 2. Fetch all products with their category names
        $products = \App\Models\Product::all();
        $this->info("Found {$products->count()} products in the database.");

        // Define mapping function
        $getNewCategoryName = function ($name, $oldCategoryName) {
            $name = strtolower($name);
            $oldCategoryName = strtolower($oldCategoryName);

            // 1. ROKOK
            if (
                str_contains($name, 'rokok') || 
                str_contains($name, 'surya') || 
                str_contains($name, 'sampoerna') || 
                str_contains($name, 'djarum') || 
                str_contains($name, 'magnum') || 
                str_contains($name, 'marlboro') || 
                str_contains($name, 'la bold') || 
                str_contains($name, 'gg mild') || 
                str_contains($name, 'gudang garam') || 
                $oldCategoryName === 'rokok'
            ) {
                return 'ROKOK';
            }

            // 2. MINUMAN
            if (
                str_contains($name, 'minuman') || 
                str_contains($name, 'teh pucuk') || 
                str_contains($name, 'aqua') || 
                str_contains($name, 'le minerale') || 
                str_contains($name, 'fanta') || 
                str_contains($name, 'coca cola') || 
                str_contains($name, 'sprite') || 
                str_contains($name, 'floridina') || 
                str_contains($name, 'kopiko') || 
                str_contains($name, 'pocari') || 
                str_contains($name, 'milku') || 
                str_contains($name, 'indomilk') || 
                str_contains($name, 'nutrisari') || 
                str_contains($name, 'kratingdaeng') || 
                str_contains($name, 'yakult') || 
                str_contains($name, 'cleo') || 
                str_contains($name, 'adem sari') || 
                str_contains($name, 'frestea') || 
                str_contains($name, 'larutan') || 
                str_contains($name, 'cincau') || 
                str_contains($name, 'kopi') || 
                str_contains($name, 'air mineral') ||
                $oldCategoryName === 'air' || 
                $oldCategoryName === 'botol' || 
                $oldCategoryName === 'minuman'
            ) {
                return 'MINUMAN';
            }

            // 3. SNACK
            if (
                str_contains($name, 'snack') || 
                str_contains($name, 'chiki') || 
                str_contains($name, 'keripik') || 
                str_contains($name, 'biskuit') || 
                str_contains($name, 'wafer') || 
                str_contains($name, 'roti') || 
                str_contains($name, 'permen') || 
                str_contains($name, 'kuaci') || 
                str_contains($name, 'kacang') || 
                str_contains($name, 'gery') || 
                str_contains($name, 'roma') || 
                str_contains($name, 'tango') || 
                str_contains($name, 'nabati') || 
                str_contains($name, 'oreo') || 
                str_contains($name, 'silverqueen') || 
                str_contains($name, 'beng beng') || 
                str_contains($name, 'astor') || 
                str_contains($name, 'piattos') || 
                str_contains($name, 'kusuka') || 
                str_contains($name, 'taro') || 
                str_contains($name, 'chitato') || 
                str_contains($name, 'lays') || 
                str_contains($name, 'qtela') || 
                $oldCategoryName === 'snack' || 
                $oldCategoryName === 'balon'
            ) {
                return 'SNACK';
            }

            // 4. KEBERSIHAN
            if (
                str_contains($name, 'sabun') || 
                str_contains($name, 'shampoo') || 
                str_contains($name, 'odol') || 
                str_contains($name, 'sikat gigi') || 
                str_contains($name, 'pewangi') || 
                str_contains($name, 'so klin') || 
                str_contains($name, 'rinso') || 
                str_contains($name, 'downy') || 
                str_contains($name, 'molto') || 
                str_contains($name, 'mama lemon') || 
                str_contains($name, 'sunlight') || 
                str_contains($name, 'wipol') || 
                str_contains($name, 'harpic') || 
                str_contains($name, 'super pell') || 
                str_contains($name, 'tissue') || 
                str_contains($name, 'tisu') || 
                str_contains($name, 'kapas') || 
                str_contains($name, 'handsanitizer') || 
                str_contains($name, 'detol') || 
                str_contains($name, 'shinzui') || 
                str_contains($name, 'lifebuoy') || 
                str_contains($name, 'biore') || 
                str_contains($name, 'lux') || 
                str_contains($name, 'sensodyne') || 
                str_contains($name, 'pepsodent') || 
                str_contains($name, 'sarung tangan') || 
                str_contains($name, 'masker') || 
                str_contains($name, 'sapu') || 
                str_contains($name, 'kemoceng') || 
                str_contains($name, 'pelan') || 
                str_contains($name, 'pembersih') || 
                $oldCategoryName === 'sabun' || 
                $oldCategoryName === 'tissue' || 
                $oldCategoryName === 'sarung_tangan' || 
                $oldCategoryName === 'kebersihan'
            ) {
                return 'KEBERSIHAN';
            }

            // 5. ATK
            if (
                str_contains($name, 'buku') || 
                str_contains($name, 'pulpen') || 
                str_contains($name, 'pensil') || 
                str_contains($name, 'penghapus') || 
                str_contains($name, 'tipex') || 
                str_contains($name, 'penggaris') || 
                str_contains($name, 'spidol') || 
                str_contains($name, 'kertas hvs') || 
                str_contains($name, 'origami') || 
                str_contains($name, 'rautan') || 
                str_contains($name, 'gunting') || 
                str_contains($name, 'cutter') || 
                str_contains($name, 'lakban') || 
                str_contains($name, 'solasi') || 
                str_contains($name, 'double tape') || 
                str_contains($name, 'lem') || 
                str_contains($name, 'stapler') || 
                str_contains($name, 'staples') || 
                str_contains($name, 'klip') || 
                str_contains($name, 'stiker') || 
                str_contains($name, 'amplop') || 
                str_contains($name, 'kwitansi') || 
                str_contains($name, 'baterai') || 
                str_contains($name, 'nota') || 
                str_contains($name, 'map') || 
                str_contains($name, 'binder') || 
                $oldCategoryName === 'atk' || 
                $oldCategoryName === 'buku' || 
                $oldCategoryName === 'pulpen' || 
                $oldCategoryName === 'pensil' || 
                $oldCategoryName === 'penghapus' || 
                $oldCategoryName === 'origami' || 
                $oldCategoryName === 'rautan' || 
                $oldCategoryName === 'gunting' || 
                $oldCategoryName === 'cutter' || 
                $oldCategoryName === 'curter' || 
                $oldCategoryName === 'lakban' || 
                $oldCategoryName === 'lem' || 
                $oldCategoryName === 'stapler' || 
                $oldCategoryName === 'staples' || 
                $oldCategoryName === 'stiker' || 
                $oldCategoryName === 'amplop' || 
                $oldCategoryName === 'baterai' || 
                $oldCategoryName === 'double'
            ) {
                return 'ATK';
            }

            // 6. SEMBAKO
            if (
                str_contains($name, 'beras') || 
                str_contains($name, 'minyak goreng') || 
                str_contains($name, 'gula') || 
                str_contains($name, 'garam') || 
                str_contains($name, 'terigu') || 
                str_contains($name, 'telur') || 
                str_contains($name, 'indomie') || 
                str_contains($name, 'sarimi') || 
                str_contains($name, 'sedaap') || 
                str_contains($name, 'mie') || 
                str_contains($name, 'kecap') || 
                str_contains($name, 'saus') || 
                str_contains($name, 'sambal') || 
                str_contains($name, 'mentega') || 
                str_contains($name, 'blue band') || 
                str_contains($name, 'susu') || 
                str_contains($name, 'kopi bubuk') || 
                str_contains($name, 'teh celup') || 
                str_contains($name, 'bawang') || 
                str_contains($name, 'cabai') || 
                str_contains($name, 'merica') || 
                str_contains($name, 'ketumbar') || 
                str_contains($name, 'penyedap') || 
                str_contains($name, 'royco') || 
                str_contains($name, 'masako') || 
                str_contains($name, 'sasa') || 
                str_contains($name, 'sardin') || 
                str_contains($name, 'sarden') || 
                str_contains($name, 'kornet') || 
                str_contains($name, 'karet') || 
                str_contains($name, 'lilin') || 
                $oldCategoryName === 'sembako' || 
                $oldCategoryName === 'karet' || 
                $oldCategoryName === 'lilin'
            ) {
                return 'SEMBAKO';
            }

            // 7. PLASTIK (Default)
            return 'PLASTIK';
        };

        // Cache category names
        $categoriesMap = \App\Models\Category::all()->pluck('name', 'id')->all();

        // 3. Map products to their new categories
        $groupedProducts = [
            'PLASTIK' => [],
            'SEMBAKO' => [],
            'ATK' => [],
            'ROKOK' => [],
            'SNACK' => [],
            'KEBERSIHAN' => [],
            'MINUMAN' => []
        ];

        foreach ($products as $product) {
            $oldCatName = $categoriesMap[$product->category_id] ?? '';
            $newCatName = $getNewCategoryName($product->name, $oldCatName);
            $groupedProducts[$newCatName][] = $product;
        }

        // 4. Assign new sequential codes and update products
        $totalUpdated = 0;
        foreach ($groupedProducts as $catName => $prods) {
            usort($prods, function ($a, $b) {
                return strcmp($a->name, $b->name);
            });

            $prefix = $targetCategories[$catName];
            $catId = $categoryModels[$catName]->id;

            $seq = 1;
            foreach ($prods as $product) {
                $newCode = $prefix . ' ' . str_pad($seq, 3, '0', STR_PAD_LEFT);
                
                $product->update([
                    'category_id' => $catId,
                    'product_code' => $newCode
                ]);
                $seq++;
                $totalUpdated++;
            }
            
            $this->line("Category: {$catName} ({$prefix}) -> Updated " . ($seq - 1) . " products.");
        }

        // 5. Clean up old categories
        $targetNames = array_keys($targetCategories);
        $emptyCategories = \App\Models\Category::whereNotIn('name', $targetNames)
            ->whereDoesntHave('products')
            ->get();

        $deletedCount = 0;
        foreach ($emptyCategories as $oldCat) {
            $oldCat->delete();
            $deletedCount++;
        }

        \Illuminate\Support\Facades\DB::commit();
        $this->info("Database cleanup completed successfully! Updated {$totalUpdated} products. Deleted {$deletedCount} empty categories.");
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\DB::rollBack();
        $this->error("Failed to clean database: " . $e->getMessage());
    }
})->purpose('Clean up database products & categories to the 7 main categories and assign sequential codes');
