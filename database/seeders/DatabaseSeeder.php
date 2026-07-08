<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users (Admin IT, Keuangan, Kasir)
        User::create([
            'name' => 'Taufiqurrahhman,S.Kom',
            'username' => '66657171',
            'email' => 'taufiq@bauntung.com',
            'password' => Hash::make('hari@hari1'),
            'role' => 'admin_it',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Siti Kamariah,S.Pd.',
            'username' => '66657172',
            'email' => 'finance@bauntung.com',
            'password' => Hash::make('hari@hari1'),
            'role' => 'keuangan',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Humairah',
            'username' => '66657173',
            'email' => 'humairah@bauntung.com',
            'password' => Hash::make('hari@hari1'),
            'role' => 'admin_kasir',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Jumiati',
            'username' => '66657174',
            'email' => 'jumiati@bauntung.com',
            'password' => Hash::make('hari@hari1'),
            'role' => 'admin_kasir',
            'is_active' => true,
        ]);

        // 2. Seed Categories
        $cat_wadah = Category::create(['name' => 'WADAH', 'description' => 'Kategori WADAH']);
        $cat_air = Category::create(['name' => 'AIR', 'description' => 'Kategori AIR']);
        $cat_amplop = Category::create(['name' => 'amplop', 'description' => 'Kategori amplop']);
        $cat_kertas = Category::create(['name' => 'KERTAS', 'description' => 'Kategori KERTAS']);
        $cat_penghapus = Category::create(['name' => 'PENGHAPUS', 'description' => 'Kategori PENGHAPUS']);
        $cat_baterai = Category::create(['name' => 'BATERAI', 'description' => 'Kategori BATERAI']);
        $cat_plastik = Category::create(['name' => 'PLASTIK', 'description' => 'Kategori PLASTIK']);
        $cat_buku = Category::create(['name' => 'BUKU', 'description' => 'Kategori BUKU']);
        $cat_balon = Category::create(['name' => 'BALON', 'description' => 'Kategori BALON']);
        $cat_botol = Category::create(['name' => 'BOTOL', 'description' => 'Kategori BOTOL']);
        $cat_alat = Category::create(['name' => 'ALAT', 'description' => 'Kategori ALAT']);
        $cat_curter = Category::create(['name' => 'CURTER', 'description' => 'Kategori CURTER']);
        $cat_double = Category::create(['name' => 'DOUBLE', 'description' => 'Kategori DOUBLE']);
        $cat_gabus = Category::create(['name' => 'GABUS', 'description' => 'Kategori GABUS']);
        $cat_gantungan = Category::create(['name' => 'GANTUNGAN', 'description' => 'Kategori GANTUNGAN']);
        $cat_gelas = Category::create(['name' => 'GELAS', 'description' => 'Kategori GELAS']);
        $cat_garfu = Category::create(['name' => 'GARFU', 'description' => 'Kategori GARFU']);
        $cat_gunting = Category::create(['name' => 'GUNTING', 'description' => 'Kategori GUNTING']);
        $cat_staples = Category::create(['name' => 'STAPLES', 'description' => 'Kategori STAPLES']);
        $cat_lem = Category::create(['name' => 'LEM', 'description' => 'Kategori LEM']);
        $cat_kertas_nasi = Category::create(['name' => 'KERTAS NASI', 'description' => 'Kategori KERTAS NASI']);
        $cat_klip = Category::create(['name' => 'KLIP', 'description' => 'Kategori KLIP']);
        $cat_kotak = Category::create(['name' => 'KOTAK', 'description' => 'Kategori KOTAK']);
        $cat_karet = Category::create(['name' => 'KARET', 'description' => 'Kategori KARET']);
        $cat_lakban = Category::create(['name' => 'LAKBAN', 'description' => 'Kategori LAKBAN']);
        $cat_box = Category::create(['name' => 'BOX', 'description' => 'Kategori BOX']);
        $cat_lilin = Category::create(['name' => 'LILIN', 'description' => 'Kategori LILIN']);
        $cat_mika = Category::create(['name' => 'MIKA', 'description' => 'Kategori MIKA']);
        $cat_tissue = Category::create(['name' => 'TISSUE', 'description' => 'Kategori TISSUE']);
        $cat_opp = Category::create(['name' => 'OPP', 'description' => 'Kategori OPP']);
        $cat_paper = Category::create(['name' => 'PAPER', 'description' => 'Kategori PAPER']);
        $cat_pulpen = Category::create(['name' => 'PULPEN', 'description' => 'Kategori PULPEN']);
        $cat_pensil = Category::create(['name' => 'PENSIL', 'description' => 'Kategori PENSIL']);
        $cat_piring = Category::create(['name' => 'PIRING', 'description' => 'Kategori PIRING']);
        $cat_origami = Category::create(['name' => 'ORIGAMI', 'description' => 'Kategori ORIGAMI']);
        $cat_rautan = Category::create(['name' => 'RAUTAN', 'description' => 'Kategori RAUTAN']);
        $cat_sabun = Category::create(['name' => 'SABUN', 'description' => 'Kategori SABUN']);
        $cat_sedotan = Category::create(['name' => 'SEDOTAN', 'description' => 'Kategori SEDOTAN']);
        $cat_sendal = Category::create(['name' => 'SENDAL', 'description' => 'Kategori SENDAL']);
        $cat_sendok = Category::create(['name' => 'SENDOK', 'description' => 'Kategori SENDOK']);
        $cat_sandal = Category::create(['name' => 'SANDAL', 'description' => 'Kategori SANDAL']);
        $cat_sarung_tangan = Category::create(['name' => 'SARUNG TANGAN', 'description' => 'Kategori SARUNG TANGAN']);
        $cat_stiker = Category::create(['name' => 'STIKER', 'description' => 'Kategori STIKER']);
        $cat_stapler = Category::create(['name' => 'STAPLER', 'description' => 'Kategori STAPLER']);
        $cat_tali = Category::create(['name' => 'TALI', 'description' => 'Kategori TALI']);
        $cat_toples = Category::create(['name' => 'TOPLES', 'description' => 'Kategori TOPLES']);
        $cat_tutup = Category::create(['name' => 'TUTUP', 'description' => 'Kategori TUTUP']);
        $cat_tusuk = Category::create(['name' => 'TUSUK', 'description' => 'Kategori TUSUK']);
        $cat_tas = Category::create(['name' => 'TAS', 'description' => 'Kategori TAS']);
        $cat_stik = Category::create(['name' => 'STIK', 'description' => 'Kategori STIK']);

        // 3. Seed Products
        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'ALM 10',
            'name' => 'ALUMINIUM ECER 0X250',
            'unit' => 'PCS',
            'buy_price' => 850.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(850.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'ALM 41',
            'name' => 'ALUMINIUM OX250',
            'unit' => 'PAK',
            'buy_price' => 77000.00,
            'sell_price' => 85000.00,
            'wholesale_price' => max(77000.00, 85000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'ALM 44',
            'name' => 'ALUMINIUM RX145',
            'unit' => 'PAK',
            'buy_price' => 60000.00,
            'sell_price' => 67000.00,
            'wholesale_price' => max(60000.00, 67000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'ALM 45',
            'name' => 'ALUMINIUM OX1225',
            'unit' => 'PAK',
            'buy_price' => 70000.00,
            'sell_price' => 77000.00,
            'wholesale_price' => max(70000.00, 77000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'ALM 46',
            'name' => 'ALUMINIUM OX100',
            'unit' => 'PAK',
            'buy_price' => 40000.00,
            'sell_price' => 46000.00,
            'wholesale_price' => max(40000.00, 46000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'ALM 47',
            'name' => 'ALUMINIUM RX50',
            'unit' => 'PAK',
            'buy_price' => 35000.00,
            'sell_price' => 42000.00,
            'wholesale_price' => max(35000.00, 42000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_air->id,
            'product_code' => 'AM',
            'name' => 'AMANAH',
            'unit' => 'DUS',
            'buy_price' => 18000.00,
            'sell_price' => 21000.00,
            'wholesale_price' => max(18000.00, 21000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_amplop->id,
            'product_code' => 'AM 1',
            'name' => 'AMPLOP MOTIF',
            'unit' => 'PAK',
            'buy_price' => 3000.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3000.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_amplop->id,
            'product_code' => 'AM 2',
            'name' => 'AMPLOP PUTIH',
            'unit' => 'PAK',
            'buy_price' => 26000.00,
            'sell_price' => 30000.00,
            'wholesale_price' => max(26000.00, 30000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_amplop->id,
            'product_code' => 'AM 3',
            'name' => 'AMPLOP ECER',
            'unit' => 'PCS',
            'buy_price' => 300.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(300.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas->id,
            'product_code' => 'AMP 1',
            'name' => 'JGN DI ANU',
            'unit' => 'PAK',
            'buy_price' => 13000.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(13000.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_amplop->id,
            'product_code' => 'AMP 34',
            'name' => 'AMPLOP KECIL',
            'unit' => 'PAK',
            'buy_price' => 4000.00,
            'sell_price' => 6500.00,
            'wholesale_price' => max(4000.00, 6500.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_penghapus->id,
            'product_code' => 'ATK 5',
            'name' => 'PENGHAPUS',
            'unit' => 'PAK',
            'buy_price' => 1500.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(1500.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_baterai->id,
            'product_code' => 'BAT',
            'name' => 'BATERAI ABC SEDANG',
            'unit' => 'PAK',
            'buy_price' => 9000.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(9000.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_baterai->id,
            'product_code' => 'BAT1',
            'name' => 'BATERAI KECIL PANASONIC',
            'unit' => 'PAK',
            'buy_price' => 4500.00,
            'sell_price' => 7000.00,
            'wholesale_price' => max(4500.00, 7000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'BBW 1',
            'name' => 'BUBBLE WRAB ECER',
            'unit' => 'PAK',
            'buy_price' => 2900.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(2900.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'BC1',
            'name' => 'BEST CLING',
            'unit' => 'PAK',
            'buy_price' => 12500.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(12500.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas->id,
            'product_code' => 'BC2',
            'name' => 'BEST FOIL ALUMINIUM',
            'unit' => 'PAK',
            'buy_price' => 13500.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(13500.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_buku->id,
            'product_code' => 'BK',
            'name' => 'BUKU MOTIF LABUBU',
            'unit' => 'PCS',
            'buy_price' => 8750.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(8750.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_buku->id,
            'product_code' => 'BK1',
            'name' => 'BUKU KUROMI',
            'unit' => 'PCS',
            'buy_price' => 9000.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(9000.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_balon->id,
            'product_code' => 'BLN 1',
            'name' => 'BALON',
            'unit' => 'PAK',
            'buy_price' => 2900.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(2900.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_balon->id,
            'product_code' => 'BLN 2',
            'name' => 'BALON SMILE',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 7000.00,
            'wholesale_price' => max(5000.00, 7000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'BNT 43',
            'name' => 'BENTO SEKAT',
            'unit' => 'PAK',
            'buy_price' => 60000.00,
            'sell_price' => 65000.00,
            'wholesale_price' => max(60000.00, 65000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'BOWL 12',
            'name' => 'PAPERBOWL 650',
            'unit' => 'DUS',
            'buy_price' => 410000.00,
            'sell_price' => 450000.00,
            'wholesale_price' => max(410000.00, 450000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_botol->id,
            'product_code' => 'BT',
            'name' => 'BOTOL 500 ML',
            'unit' => 'PCS',
            'buy_price' => 1450.00,
            'sell_price' => 1800.00,
            'wholesale_price' => max(1450.00, 1800.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'BTK 1',
            'name' => 'PLASTIK BATIK 22X26',
            'unit' => 'PAK',
            'buy_price' => 18500.00,
            'sell_price' => 26000.00,
            'wholesale_price' => max(18500.00, 26000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'BTK 2',
            'name' => 'PLASTIK BATIK 35X40',
            'unit' => 'PAK',
            'buy_price' => 35000.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(35000.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_botol->id,
            'product_code' => 'BTL',
            'name' => 'BOTOL SPRAY',
            'unit' => 'PCS',
            'buy_price' => 1250.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(1250.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_botol->id,
            'product_code' => 'BTL 1',
            'name' => 'BOTOL 100 ML',
            'unit' => 'PCS',
            'buy_price' => 1000.00,
            'sell_price' => 1400.00,
            'wholesale_price' => max(1000.00, 1400.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_botol->id,
            'product_code' => 'BTL 11',
            'name' => 'BOTOL 250 ML KOTAK',
            'unit' => 'PCS',
            'buy_price' => 2200.00,
            'sell_price' => 2800.00,
            'wholesale_price' => max(2200.00, 2800.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_botol->id,
            'product_code' => 'BTL 2',
            'name' => 'BOTOL 500 ML',
            'unit' => 'PCS',
            'buy_price' => 1450.00,
            'sell_price' => 1800.00,
            'wholesale_price' => max(1450.00, 1800.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_botol->id,
            'product_code' => 'BTL 22',
            'name' => 'BOTOL PANJANG',
            'unit' => 'PCS',
            'buy_price' => 3000.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(3000.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_botol->id,
            'product_code' => 'BTL 3',
            'name' => 'BOTOL 1 LITER',
            'unit' => 'PCS',
            'buy_price' => 1500.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(1500.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_botol->id,
            'product_code' => 'BTL 5',
            'name' => 'BOTOL 250ML',
            'unit' => 'PCS',
            'buy_price' => 1100.00,
            'sell_price' => 1400.00,
            'wholesale_price' => max(1100.00, 1400.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_alat->id,
            'product_code' => 'CP',
            'name' => 'CEPER MIKA',
            'unit' => 'PCS',
            'buy_price' => 4600.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(4600.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'CUP',
            'name' => 'CUP PUDING 90 ML + TUTUP',
            'unit' => 'PAK',
            'buy_price' => 4650.00,
            'sell_price' => 8500.00,
            'wholesale_price' => max(4650.00, 8500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'CUP1',
            'name' => 'CUP SAOS 25 ML',
            'unit' => 'PAK',
            'buy_price' => 6500.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(6500.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_curter->id,
            'product_code' => 'CURTER',
            'name' => 'CUTTERA-18',
            'unit' => 'PCS',
            'buy_price' => 4166.00,
            'sell_price' => 7000.00,
            'wholesale_price' => max(4166.00, 7000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM',
            'name' => 'DM KOTAK 150 ML',
            'unit' => 'PAK',
            'buy_price' => 11850.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(11850.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM 40',
            'name' => 'DM 50ML',
            'unit' => 'PAK',
            'buy_price' => 13200.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(13200.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM 6',
            'name' => 'DM 1500 ML ECER',
            'unit' => 'PCS',
            'buy_price' => 2400.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(2400.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM 87',
            'name' => 'DM 3000 ML',
            'unit' => 'PAK',
            'buy_price' => 74400.00,
            'sell_price' => 90000.00,
            'wholesale_price' => max(74400.00, 90000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM ECER 1',
            'name' => 'DM KOTAK 1000 ML',
            'unit' => 'PCS',
            'buy_price' => 1621.00,
            'sell_price' => 2500.00,
            'wholesale_price' => max(1621.00, 2500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM ECER 2',
            'name' => 'DM SEGIPANJANG 1000 ML',
            'unit' => 'PCS',
            'buy_price' => 1046.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(1046.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM ECER 3',
            'name' => 'DM SEGIPANJANG 500 ML',
            'unit' => 'PCS',
            'buy_price' => 886.00,
            'sell_price' => 1500.00,
            'wholesale_price' => max(886.00, 1500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM ECER 4',
            'name' => 'DM SEGIPANJANG 650 ML',
            'unit' => 'PCS',
            'buy_price' => 910.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(910.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM ECER 5',
            'name' => 'DM SEGIPANJANG 750 ML',
            'unit' => 'PCS',
            'buy_price' => 954.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(954.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM ECER 6',
            'name' => 'DM SEGIPANJANG 1000 ML',
            'unit' => 'PCS',
            'buy_price' => 1046.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(1046.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM ECER 7',
            'name' => 'DM KOTAK 2000 ML',
            'unit' => 'PCS',
            'buy_price' => 2556.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(2556.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM ECER 88',
            'name' => 'DM 3000 ML ECER',
            'unit' => 'PCS',
            'buy_price' => 3600.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(3600.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM1',
            'name' => 'DM KOTAK 200 ML',
            'unit' => 'PAK',
            'buy_price' => 17250.00,
            'sell_price' => 22000.00,
            'wholesale_price' => max(17250.00, 22000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM10',
            'name' => 'DM BULAT 500 ML',
            'unit' => 'PAK',
            'buy_price' => 18750.00,
            'sell_price' => 24000.00,
            'wholesale_price' => max(18750.00, 24000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM11',
            'name' => 'DM SEGIPANJANG 500 ML',
            'unit' => 'PAK',
            'buy_price' => 21650.00,
            'sell_price' => 32000.00,
            'wholesale_price' => max(21650.00, 32000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM12',
            'name' => 'DM SEGIPANJANG 650ML',
            'unit' => 'PAK',
            'buy_price' => 22750.00,
            'sell_price' => 36000.00,
            'wholesale_price' => max(22750.00, 36000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM13',
            'name' => 'DM SEGIPANJANG 750 ML',
            'unit' => 'PAK',
            'buy_price' => 23850.00,
            'sell_price' => 38000.00,
            'wholesale_price' => max(23850.00, 38000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM14',
            'name' => 'DM SEGIPANJANG 1000 ML',
            'unit' => 'PAK',
            'buy_price' => 26650.00,
            'sell_price' => 35000.00,
            'wholesale_price' => max(26650.00, 35000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM15',
            'name' => 'DM KOTAK 2000 ML',
            'unit' => 'PAK',
            'buy_price' => 63900.00,
            'sell_price' => 90000.00,
            'wholesale_price' => max(63900.00, 90000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM2',
            'name' => 'DM KOTAK 300 ML',
            'unit' => 'PAK',
            'buy_price' => 19150.00,
            'sell_price' => 23000.00,
            'wholesale_price' => max(19150.00, 23000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM3',
            'name' => 'DM KOTAK 500 ML',
            'unit' => 'PAK',
            'buy_price' => 21450.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(21450.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM4',
            'name' => 'DM KOTAK 1000 ML',
            'unit' => 'PAK',
            'buy_price' => 40525.00,
            'sell_price' => 55000.00,
            'wholesale_price' => max(40525.00, 55000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM5',
            'name' => 'DM KOTAK 1500 ML',
            'unit' => 'PAK',
            'buy_price' => 45200.00,
            'sell_price' => 60000.00,
            'wholesale_price' => max(45200.00, 60000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM6',
            'name' => 'DM BULAT 200 ML',
            'unit' => 'PAK',
            'buy_price' => 12150.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(12150.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM7',
            'name' => 'DM BULAT 300 ML',
            'unit' => 'PAK',
            'buy_price' => 13250.00,
            'sell_price' => 21000.00,
            'wholesale_price' => max(13250.00, 21000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM8',
            'name' => 'DM BULAT 400 ML',
            'unit' => 'PAK',
            'buy_price' => 15200.00,
            'sell_price' => 22000.00,
            'wholesale_price' => max(15200.00, 22000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'DM9',
            'name' => 'DM BULAT 450 ML',
            'unit' => 'PAK',
            'buy_price' => 15200.00,
            'sell_price' => 23000.00,
            'wholesale_price' => max(15200.00, 23000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_double->id,
            'product_code' => 'DT',
            'name' => 'DOUBLE TAPE KECIL',
            'unit' => 'PCS',
            'buy_price' => 2812.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2812.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_double->id,
            'product_code' => 'DT1',
            'name' => 'DOUBLE TAPE SEDANG',
            'unit' => 'PCS',
            'buy_price' => 5625.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(5625.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_air->id,
            'product_code' => 'F1',
            'name' => 'FANTA 1,5 LITER',
            'unit' => 'PCS',
            'buy_price' => 23000.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(23000.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'FT 1',
            'name' => 'FOOD TRAY LARGE',
            'unit' => 'PAK',
            'buy_price' => 18000.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(18000.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'FT 2',
            'name' => 'FOOD TRAY SMALL',
            'unit' => 'PAK',
            'buy_price' => 12500.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(12500.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gabus->id,
            'product_code' => 'GB',
            'name' => 'GABUS KECIL',
            'unit' => 'PAK',
            'buy_price' => 29000.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(29000.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gabus->id,
            'product_code' => 'GB1',
            'name' => 'GABUS KECIL',
            'unit' => 'PCS',
            'buy_price' => 290.00,
            'sell_price' => 450.00,
            'wholesale_price' => max(290.00, 450.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gabus->id,
            'product_code' => 'GB2',
            'name' => 'GABUS BESAR',
            'unit' => 'PAK',
            'buy_price' => 42000.00,
            'sell_price' => 55000.00,
            'wholesale_price' => max(42000.00, 55000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'GBS 12',
            'name' => 'GABUS BESAR ECER',
            'unit' => 'PCS',
            'buy_price' => 500.00,
            'sell_price' => 600.00,
            'wholesale_price' => max(500.00, 600.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gantungan->id,
            'product_code' => 'GK 1',
            'name' => 'GANTUNGAN KUNCI',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(5000.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gantungan->id,
            'product_code' => 'GK 2',
            'name' => 'GANTUNGAN LOTSO',
            'unit' => 'PCS',
            'buy_price' => 3800.00,
            'sell_price' => 7000.00,
            'wholesale_price' => max(3800.00, 7000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL',
            'name' => 'GELAS CHERIA 14',
            'unit' => 'PAK',
            'buy_price' => 8250.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(8250.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL 55',
            'name' => 'STARINDO 16 MOTIF',
            'unit' => 'PCS',
            'buy_price' => 17250.00,
            'sell_price' => 22000.00,
            'wholesale_price' => max(17250.00, 22000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL 86',
            'name' => 'GELAS OVAL 16 OZ',
            'unit' => 'PAK',
            'buy_price' => 14000.00,
            'sell_price' => 17000.00,
            'wholesale_price' => max(14000.00, 17000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL 87',
            'name' => 'GELAS OVAL 14 OZ',
            'unit' => 'PAK',
            'buy_price' => 14000.00,
            'sell_price' => 17000.00,
            'wholesale_price' => max(14000.00, 17000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL1',
            'name' => 'GELAS KOPI',
            'unit' => 'PAK',
            'buy_price' => 9000.00,
            'sell_price' => 16000.00,
            'wholesale_price' => max(9000.00, 16000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL10',
            'name' => 'GELAS VICTORY INJECTION 500 ML',
            'unit' => 'PAK',
            'buy_price' => 32000.00,
            'sell_price' => 35000.00,
            'wholesale_price' => max(32000.00, 35000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL11',
            'name' => 'GELAS VICTORY INJECTION 400 ML',
            'unit' => 'PAK',
            'buy_price' => 30000.00,
            'sell_price' => 33000.00,
            'wholesale_price' => max(30000.00, 33000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL12',
            'name' => 'GELAS CHERIA 10',
            'unit' => 'PAK',
            'buy_price' => 8250.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(8250.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL2',
            'name' => 'GELAS PULKADOT',
            'unit' => 'PAK',
            'buy_price' => 7000.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(7000.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL3',
            'name' => 'GELAS CUP 22 OZ',
            'unit' => 'PAK',
            'buy_price' => 15500.00,
            'sell_price' => 23000.00,
            'wholesale_price' => max(15500.00, 23000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL4',
            'name' => 'GELAS STARINDO 16',
            'unit' => 'PAK',
            'buy_price' => 11875.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(11875.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL5',
            'name' => 'GELAS CHERIA 12',
            'unit' => 'PAK',
            'buy_price' => 8250.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(8250.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL6',
            'name' => 'GELAS CHERIA 16',
            'unit' => 'PAK',
            'buy_price' => 8250.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(8250.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL7',
            'name' => 'GELAS AQUA',
            'unit' => 'PAK',
            'buy_price' => 5250.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(5250.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL8',
            'name' => 'GELAS STARINDO 12',
            'unit' => 'PAK',
            'buy_price' => 11625.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(11625.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GL9',
            'name' => 'GELAS STARINDO 14',
            'unit' => 'PAK',
            'buy_price' => 11625.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(11625.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GLS 12',
            'name' => 'ROYAL 18 OZ',
            'unit' => 'PCS',
            'buy_price' => 13250.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(13250.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gelas->id,
            'product_code' => 'GLS 13',
            'name' => 'ROYAL 22 OZ',
            'unit' => 'PCS',
            'buy_price' => 13250.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(13250.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_garfu->id,
            'product_code' => 'GR',
            'name' => 'GARFU KECIL KUE',
            'unit' => 'PAK',
            'buy_price' => 2500.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2500.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gunting->id,
            'product_code' => 'GT',
            'name' => 'GUNTING GUNINDO OPL',
            'unit' => 'PCS',
            'buy_price' => 5833.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(5833.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gunting->id,
            'product_code' => 'GT1',
            'name' => 'GUNTING GUNINDO HB55',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(5000.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_gunting->id,
            'product_code' => 'GT2',
            'name' => 'GUNTING V-TRO',
            'unit' => 'PCS',
            'buy_price' => 7500.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(7500.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'HL1',
            'name' => 'PLASTIK HELLO KITTY KECIL',
            'unit' => 'PAK',
            'buy_price' => 10000.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(10000.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_staples->id,
            'product_code' => 'ISI STAPLES',
            'name' => 'ISI STAPLES MAX NO 10',
            'unit' => 'PCS',
            'buy_price' => 3000.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(3000.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_staples->id,
            'product_code' => 'ISI STAPLES2',
            'name' => 'ISI STAPLES MAX NO.3',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 7000.00,
            'wholesale_price' => max(5000.00, 7000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_lem->id,
            'product_code' => 'ISOLASI',
            'name' => 'ISOLASI KECIL',
            'unit' => 'PCS',
            'buy_price' => 1166.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(1166.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_lem->id,
            'product_code' => 'ISOLASI 3',
            'name' => 'ISOLASI KECIL PAK',
            'unit' => 'PAK',
            'buy_price' => 14000.00,
            'sell_price' => 30000.00,
            'wholesale_price' => max(14000.00, 30000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_lem->id,
            'product_code' => 'ISOLASI1',
            'name' => 'ISOLASI SEDANG',
            'unit' => 'PCS',
            'buy_price' => 4000.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(4000.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'KHR 12',
            'name' => 'KHARISMA BENING',
            'unit' => 'PCS',
            'buy_price' => 10000.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(10000.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'KK',
            'name' => 'KLIP KRIPIK',
            'unit' => 'PAK',
            'buy_price' => 17000.00,
            'sell_price' => 24000.00,
            'wholesale_price' => max(17000.00, 24000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas_nasi->id,
            'product_code' => 'KL',
            'name' => 'R5 COKLAT ECER',
            'unit' => 'PCS',
            'buy_price' => 390.00,
            'sell_price' => 600.00,
            'wholesale_price' => max(390.00, 600.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'KL 55',
            'name' => 'KLIR 25 ML',
            'unit' => 'PAK',
            'buy_price' => 6500.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(6500.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_klip->id,
            'product_code' => 'KLIP',
            'name' => 'KLIP 5X8',
            'unit' => 'PCS',
            'buy_price' => 1900.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(1900.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_klip->id,
            'product_code' => 'KLIP 34',
            'name' => 'KLIP 35X45',
            'unit' => 'PCS',
            'buy_price' => 1250.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(1250.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_klip->id,
            'product_code' => 'KLIP 87',
            'name' => 'KLIP HORE 16X25',
            'unit' => 'PAK',
            'buy_price' => 37000.00,
            'sell_price' => 45000.00,
            'wholesale_price' => max(37000.00, 45000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_klip->id,
            'product_code' => 'KLIP1',
            'name' => 'KLIP 12X8',
            'unit' => 'PCS',
            'buy_price' => 4010.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(4010.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_klip->id,
            'product_code' => 'KLIP2',
            'name' => 'KLIP 7X10',
            'unit' => 'PCS',
            'buy_price' => 2850.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(2850.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_klip->id,
            'product_code' => 'KLIP3',
            'name' => 'KLIP 6X4',
            'unit' => 'PCS',
            'buy_price' => 1120.00,
            'sell_price' => 2500.00,
            'wholesale_price' => max(1120.00, 2500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'KLIP4',
            'name' => 'KLIP 13X8,7',
            'unit' => 'PCS',
            'buy_price' => 5192.00,
            'sell_price' => 9000.00,
            'wholesale_price' => max(5192.00, 9000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'KLIP5',
            'name' => 'KLIP 6X10',
            'unit' => 'PCS',
            'buy_price' => 2465.00,
            'sell_price' => 3500.00,
            'wholesale_price' => max(2465.00, 3500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'KLIP6',
            'name' => 'KLIP 10X15',
            'unit' => 'PCS',
            'buy_price' => 2130.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(2130.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'KLIR 2',
            'name' => 'KLIR 50 ML',
            'unit' => 'PAK',
            'buy_price' => 12000.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(12000.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas_nasi->id,
            'product_code' => 'KN',
            'name' => 'KERTAS NASI PUTIH',
            'unit' => 'PAK',
            'buy_price' => 6000.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(6000.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 09',
            'name' => 'R5 MOTIF ECER',
            'unit' => 'PCS',
            'buy_price' => 480.00,
            'sell_price' => 800.00,
            'wholesale_price' => max(480.00, 800.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 1',
            'name' => 'R3 PUTIH',
            'unit' => 'PAK',
            'buy_price' => 38000.00,
            'sell_price' => 55000.00,
            'wholesale_price' => max(38000.00, 55000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 11',
            'name' => 'R8 MOTIF ECER',
            'unit' => 'PCS',
            'buy_price' => 730.00,
            'sell_price' => 1300.00,
            'wholesale_price' => max(730.00, 1300.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 2',
            'name' => 'R5 PUTIH',
            'unit' => 'PAK',
            'buy_price' => 50000.00,
            'sell_price' => 65000.00,
            'wholesale_price' => max(50000.00, 65000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 3',
            'name' => 'R9 MOTIF',
            'unit' => 'PAK',
            'buy_price' => 98000.00,
            'sell_price' => 140000.00,
            'wholesale_price' => max(98000.00, 140000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 4',
            'name' => 'R3 MOTIF',
            'unit' => 'PAK',
            'buy_price' => 39500.00,
            'sell_price' => 65000.00,
            'wholesale_price' => max(39500.00, 65000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 44',
            'name' => 'R3 COKLAT ECER',
            'unit' => 'PCS',
            'buy_price' => 500.00,
            'sell_price' => 600.00,
            'wholesale_price' => max(500.00, 600.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 49',
            'name' => 'R3 COKLAT',
            'unit' => 'PAK',
            'buy_price' => 31000.00,
            'sell_price' => 50000.00,
            'wholesale_price' => max(31000.00, 50000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 54',
            'name' => 'R8 MOTIF',
            'unit' => 'PAK',
            'buy_price' => 73000.00,
            'sell_price' => 120000.00,
            'wholesale_price' => max(73000.00, 120000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas->id,
            'product_code' => 'KN 69',
            'name' => 'KERTAS NASI ECER',
            'unit' => 'LEMBAR',
            'buy_price' => 124.00,
            'sell_price' => 300.00,
            'wholesale_price' => max(124.00, 300.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 88',
            'name' => 'R9 COKLAT',
            'unit' => 'PAK',
            'buy_price' => 67400.00,
            'sell_price' => 85000.00,
            'wholesale_price' => max(67400.00, 85000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN 95',
            'name' => 'R5 MOTIF',
            'unit' => 'PAK',
            'buy_price' => 44500.00,
            'sell_price' => 75000.00,
            'wholesale_price' => max(44500.00, 75000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN ECER',
            'name' => 'R3 PUTIH ECER',
            'unit' => 'PCS',
            'buy_price' => 400.00,
            'sell_price' => 600.00,
            'wholesale_price' => max(400.00, 600.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN ECER 1',
            'name' => 'R3 MOTIF ECER',
            'unit' => 'PCS',
            'buy_price' => 395.00,
            'sell_price' => 700.00,
            'wholesale_price' => max(395.00, 700.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN ECER 2',
            'name' => 'R5 PUTIH ECER',
            'unit' => 'PCS',
            'buy_price' => 500.00,
            'sell_price' => 700.00,
            'wholesale_price' => max(500.00, 700.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN ECER 21',
            'name' => 'R9 PUTIH ECER',
            'unit' => 'PCS',
            'buy_price' => 1300.00,
            'sell_price' => 1400.00,
            'wholesale_price' => max(1300.00, 1400.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KN ECER 3',
            'name' => 'R9 MOTIF ECER',
            'unit' => 'PCS',
            'buy_price' => 980.00,
            'sell_price' => 1500.00,
            'wholesale_price' => max(980.00, 1500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'KN ECER 54',
            'name' => 'R9 COKLAT ECER',
            'unit' => 'PCS',
            'buy_price' => 760.00,
            'sell_price' => 1000.00,
            'wholesale_price' => max(760.00, 1000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas_nasi->id,
            'product_code' => 'KN1',
            'name' => 'KERTAS NASI GAJAH',
            'unit' => 'PAK',
            'buy_price' => 31000.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(31000.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas_nasi->id,
            'product_code' => 'KN2',
            'name' => 'KERTAS NASI SUPERSTAR',
            'unit' => 'PAK',
            'buy_price' => 18999.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(18999.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas_nasi->id,
            'product_code' => 'KN3',
            'name' => 'KERTAS NASI OKEY',
            'unit' => 'PAK',
            'buy_price' => 23000.00,
            'sell_price' => 28000.00,
            'wholesale_price' => max(23000.00, 28000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas->id,
            'product_code' => 'KN4',
            'name' => 'KERTAS KFC',
            'unit' => 'PAK',
            'buy_price' => 5600.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(5600.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas->id,
            'product_code' => 'KO',
            'name' => 'KERTAS ORIGAMI 12X12',
            'unit' => 'PAK',
            'buy_price' => 2500.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2500.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas->id,
            'product_code' => 'KO1',
            'name' => 'KERTAS ORIGAMI 14X14',
            'unit' => 'PAK',
            'buy_price' => 3333.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3333.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas->id,
            'product_code' => 'KO2',
            'name' => 'KERTAS ORIGAMI 16X16',
            'unit' => 'PAK',
            'buy_price' => 4166.00,
            'sell_price' => 7000.00,
            'wholesale_price' => max(4166.00, 7000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KOTAK THINWALL',
            'name' => 'KOTAK THINWALL VICTORY 750ML',
            'unit' => 'PAK',
            'buy_price' => 25500.00,
            'sell_price' => 34000.00,
            'wholesale_price' => max(25500.00, 34000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_karet->id,
            'product_code' => 'KRT',
            'name' => 'KARET 222 1 ONS',
            'unit' => 'PCS',
            'buy_price' => 2500.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2500.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'KT 5',
            'name' => 'KANTONG GRADE',
            'unit' => 'PAK',
            'buy_price' => 25000.00,
            'sell_price' => 30000.00,
            'wholesale_price' => max(25000.00, 30000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KTK 1',
            'name' => 'KOTAK KARDUS',
            'unit' => 'PCS',
            'buy_price' => 3960.00,
            'sell_price' => 7000.00,
            'wholesale_price' => max(3960.00, 7000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KTK 11',
            'name' => 'KOTAK R12',
            'unit' => 'PCS',
            'buy_price' => 1500.00,
            'sell_price' => 2500.00,
            'wholesale_price' => max(1500.00, 2500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KTK 2',
            'name' => 'KOTAK EID KECIL',
            'unit' => 'PCS',
            'buy_price' => 4400.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(4400.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KTK 23',
            'name' => 'KARDUS RAYA',
            'unit' => 'PCS',
            'buy_price' => 12617.00,
            'sell_price' => 17000.00,
            'wholesale_price' => max(12617.00, 17000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KTK 3',
            'name' => 'KOTAK EID SEDANG',
            'unit' => 'PCS',
            'buy_price' => 7960.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(7960.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KTK 50',
            'name' => 'R8 PUTIH',
            'unit' => 'PAK',
            'buy_price' => 93000.00,
            'sell_price' => 110000.00,
            'wholesale_price' => max(93000.00, 110000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KTK 55',
            'name' => 'R8 COKLAT ECER',
            'unit' => 'PCS',
            'buy_price' => 680.00,
            'sell_price' => 800.00,
            'wholesale_price' => max(680.00, 800.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KTK 59',
            'name' => 'R9 PUTIH',
            'unit' => 'PAK',
            'buy_price' => 127000.00,
            'sell_price' => 135000.00,
            'wholesale_price' => max(127000.00, 135000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'KTK 66',
            'name' => 'R8 COKLAT',
            'unit' => 'PAK',
            'buy_price' => 60000.00,
            'sell_price' => 75000.00,
            'wholesale_price' => max(60000.00, 75000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kotak->id,
            'product_code' => 'KTK 76',
            'name' => 'R5 COKLAT',
            'unit' => 'PAK',
            'buy_price' => 35000.00,
            'sell_price' => 55000.00,
            'wholesale_price' => max(35000.00, 55000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_kertas->id,
            'product_code' => 'KTS 11',
            'name' => 'KERTAS SAMIR OKKY',
            'unit' => 'PAK',
            'buy_price' => 22360.00,
            'sell_price' => 27000.00,
            'wholesale_price' => max(22360.00, 27000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_lakban->id,
            'product_code' => 'LAK',
            'name' => 'LAKBAN BENING',
            'unit' => 'PCS',
            'buy_price' => 6909.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(6909.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_lakban->id,
            'product_code' => 'LAK 2',
            'name' => 'LAKBAN COKLAT',
            'unit' => 'PCS',
            'buy_price' => 7500.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(7500.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_lakban->id,
            'product_code' => 'LAK 3',
            'name' => 'LAKBAN HITAM 36',
            'unit' => 'PCS',
            'buy_price' => 9160.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(9160.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_lakban->id,
            'product_code' => 'LAK 4',
            'name' => 'LAKBAN HITAM 48',
            'unit' => 'PCS',
            'buy_price' => 12500.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(12500.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'LB',
            'name' => 'LUNCH BOX COKLAT 18X11',
            'unit' => 'PAK',
            'buy_price' => 45000.00,
            'sell_price' => 75000.00,
            'wholesale_price' => max(45000.00, 75000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_box->id,
            'product_code' => 'LB 2',
            'name' => 'LUNCH BOX COKLAT 20X13',
            'unit' => 'PAK',
            'buy_price' => 54000.00,
            'sell_price' => 85000.00,
            'wholesale_price' => max(54000.00, 85000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'LB 67',
            'name' => 'DM LB ECER',
            'unit' => 'PCS',
            'buy_price' => 2000.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(2000.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'LB 76',
            'name' => 'DM LB 401S',
            'unit' => 'PAK',
            'buy_price' => 40200.00,
            'sell_price' => 50000.00,
            'wholesale_price' => max(40200.00, 50000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'LB 77',
            'name' => 'DM LB 402B',
            'unit' => 'PAK',
            'buy_price' => 40200.00,
            'sell_price' => 50000.00,
            'wholesale_price' => max(40200.00, 50000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'LB 78',
            'name' => 'DM LB 403C',
            'unit' => 'PAK',
            'buy_price' => 40200.00,
            'sell_price' => 50000.00,
            'wholesale_price' => max(40200.00, 50000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'LB ECER 23',
            'name' => 'LUNCHBOX L ECER',
            'unit' => 'PCS',
            'buy_price' => 1140.00,
            'sell_price' => 1800.00,
            'wholesale_price' => max(1140.00, 1800.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'LB ECER 33',
            'name' => 'LUNCHBOX M ECER',
            'unit' => 'PCS',
            'buy_price' => 500.00,
            'sell_price' => 1000.00,
            'wholesale_price' => max(500.00, 1000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_lilin->id,
            'product_code' => 'LLN 1',
            'name' => 'LILIN PAPERMINT',
            'unit' => 'PCS',
            'buy_price' => 1875.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(1875.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_box->id,
            'product_code' => 'LUNCH BOX',
            'name' => 'LUNCH BOX PUTIH L',
            'unit' => 'PAK',
            'buy_price' => 57000.00,
            'sell_price' => 75000.00,
            'wholesale_price' => max(57000.00, 75000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_box->id,
            'product_code' => 'LUNCH BOX 1',
            'name' => 'LUNCH BOX PUTIH M',
            'unit' => 'PAK',
            'buy_price' => 75000.00,
            'sell_price' => 90000.00,
            'wholesale_price' => max(75000.00, 90000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA',
            'name' => 'MIKA BUNDAR UK 25 MANTAP',
            'unit' => 'PCS',
            'buy_price' => 2580.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2580.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 1 ECER',
            'name' => 'MIKA LUX 4T',
            'unit' => 'PCS',
            'buy_price' => 112.00,
            'sell_price' => 300.00,
            'wholesale_price' => max(112.00, 300.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 10',
            'name' => 'MIKA BROWNIES BESAR',
            'unit' => 'PAK',
            'buy_price' => 28000.00,
            'sell_price' => 35000.00,
            'wholesale_price' => max(28000.00, 35000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 10 ECER',
            'name' => 'MIKA BROWNIES BESAR',
            'unit' => 'PCS',
            'buy_price' => 500.00,
            'sell_price' => 1000.00,
            'wholesale_price' => max(500.00, 1000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 11',
            'name' => 'MIKA BROWNIES 02',
            'unit' => 'PAK',
            'buy_price' => 21250.00,
            'sell_price' => 30000.00,
            'wholesale_price' => max(21250.00, 30000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 12',
            'name' => 'MIKA 3CA',
            'unit' => 'PAK',
            'buy_price' => 24750.00,
            'sell_price' => 33000.00,
            'wholesale_price' => max(24750.00, 33000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 16',
            'name' => 'MIKA KOTAK BESAR',
            'unit' => 'PCS',
            'buy_price' => 2000.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(2000.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 17',
            'name' => 'MIKA KOTAK KECIL',
            'unit' => 'PCS',
            'buy_price' => 950.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(950.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 2 ECER',
            'name' => 'MIKA LUX L2A',
            'unit' => 'PCS',
            'buy_price' => 530.00,
            'sell_price' => 1000.00,
            'wholesale_price' => max(530.00, 1000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 3 ECER',
            'name' => 'MIKA 3T',
            'unit' => 'PCS',
            'buy_price' => 200.00,
            'sell_price' => 300.00,
            'wholesale_price' => max(200.00, 300.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 4',
            'name' => 'MIKA 3A',
            'unit' => 'PAK',
            'buy_price' => 30250.00,
            'sell_price' => 35000.00,
            'wholesale_price' => max(30250.00, 35000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 4 ECER',
            'name' => 'MIKA 3A',
            'unit' => 'PCS',
            'buy_price' => 302.00,
            'sell_price' => 500.00,
            'wholesale_price' => max(302.00, 500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 5',
            'name' => 'MIKA NASI 4 SEKAT LUX',
            'unit' => 'PAK',
            'buy_price' => 13500.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(13500.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 5 ECER',
            'name' => 'MIKA NASI 4 SEKAT',
            'unit' => 'PCS',
            'buy_price' => 140.00,
            'sell_price' => 300.00,
            'wholesale_price' => max(140.00, 300.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 6',
            'name' => 'MIKA BURGER',
            'unit' => 'PAK',
            'buy_price' => 7000.00,
            'sell_price' => 12500.00,
            'wholesale_price' => max(7000.00, 12500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 69',
            'name' => 'MIKA NASI 4 SEKAT ORI',
            'unit' => 'PAK',
            'buy_price' => 7100.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(7100.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 7',
            'name' => 'CUP KUE',
            'unit' => 'PAK',
            'buy_price' => 10750.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(10750.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 8',
            'name' => 'MIKA BUNDAR UK 25 MANTAP',
            'unit' => 'PAK',
            'buy_price' => 129000.00,
            'sell_price' => 145000.00,
            'wholesale_price' => max(129000.00, 145000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 8 ECER',
            'name' => 'MIKA BUNDAR UK 22',
            'unit' => 'PCS',
            'buy_price' => 1300.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(1300.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 85',
            'name' => 'MIKA KUE 7T',
            'unit' => 'PCS',
            'buy_price' => 4500.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(4500.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 9',
            'name' => 'MIKA JUMBO 1 NS SEGI EMPAT',
            'unit' => 'PAK',
            'buy_price' => 74000.00,
            'sell_price' => 90000.00,
            'wholesale_price' => max(74000.00, 90000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA 9 ECER',
            'name' => 'MIKA JUMBO 1 NS SEGI EMPAT',
            'unit' => 'PCS',
            'buy_price' => 1480.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(1480.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA ECER',
            'name' => 'MIKA 3CA',
            'unit' => 'PCS',
            'buy_price' => 247.00,
            'sell_price' => 500.00,
            'wholesale_price' => max(247.00, 500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA1',
            'name' => 'MIKA LUX 4T',
            'unit' => 'PAK',
            'buy_price' => 11250.00,
            'sell_price' => 16000.00,
            'wholesale_price' => max(11250.00, 16000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA2',
            'name' => 'MIKA LUX L2A',
            'unit' => 'PAK',
            'buy_price' => 26500.00,
            'sell_price' => 38000.00,
            'wholesale_price' => max(26500.00, 38000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_mika->id,
            'product_code' => 'MIKA3',
            'name' => 'MIKA 3T',
            'unit' => 'PAK',
            'buy_price' => 20000.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(20000.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_wadah->id,
            'product_code' => 'MK 12',
            'name' => 'GABUS BURGER',
            'unit' => 'PAK',
            'buy_price' => 56000.00,
            'sell_price' => 70000.00,
            'wholesale_price' => max(56000.00, 70000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'NICE',
            'name' => 'NICE 1000 GR',
            'unit' => 'DUS',
            'buy_price' => 337500.00,
            'sell_price' => 360000.00,
            'wholesale_price' => max(337500.00, 360000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_buku->id,
            'product_code' => 'NOT1',
            'name' => 'NOTA 1 PLY',
            'unit' => 'PCS',
            'buy_price' => 1811.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(1811.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_buku->id,
            'product_code' => 'NOT2',
            'name' => 'NOTA 2 PLY',
            'unit' => 'PCS',
            'buy_price' => 2600.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2600.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_buku->id,
            'product_code' => 'NOT3',
            'name' => 'NOTA 3 PLY',
            'unit' => 'PCS',
            'buy_price' => 3665.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3665.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 1',
            'name' => 'OPP 15X15',
            'unit' => 'PCS',
            'buy_price' => 5800.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(5800.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 2',
            'name' => 'OPP 14X14',
            'unit' => 'PCS',
            'buy_price' => 5100.00,
            'sell_price' => 9000.00,
            'wholesale_price' => max(5100.00, 9000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 3',
            'name' => 'OPP 13x13',
            'unit' => 'PCS',
            'buy_price' => 3125.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(3125.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 4',
            'name' => 'OPP 10X10',
            'unit' => 'PAK',
            'buy_price' => 3125.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(3125.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_opp->id,
            'product_code' => 'OPP 45',
            'name' => 'OPP 7x15',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(5000.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 50',
            'name' => 'OPP 9X9',
            'unit' => 'PAK',
            'buy_price' => 2500.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2500.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 55',
            'name' => 'OPP 35X40',
            'unit' => 'PAK',
            'buy_price' => 28000.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(28000.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 6',
            'name' => 'OPP 22X35',
            'unit' => 'PAK',
            'buy_price' => 17000.00,
            'sell_price' => 24000.00,
            'wholesale_price' => max(17000.00, 24000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 65',
            'name' => 'OPP 11X11',
            'unit' => 'PAK',
            'buy_price' => 3700.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3700.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 66',
            'name' => 'OPP 25X35',
            'unit' => 'PAK',
            'buy_price' => 16500.00,
            'sell_price' => 28000.00,
            'wholesale_price' => max(16500.00, 28000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 7',
            'name' => 'OPP 20X30',
            'unit' => 'PAK',
            'buy_price' => 17000.00,
            'sell_price' => 22000.00,
            'wholesale_price' => max(17000.00, 22000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 76',
            'name' => 'OPP 30X35',
            'unit' => 'PAK',
            'buy_price' => 20000.00,
            'sell_price' => 30000.00,
            'wholesale_price' => max(20000.00, 30000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP 77',
            'name' => 'OPP 28X35',
            'unit' => 'PAK',
            'buy_price' => 18000.00,
            'sell_price' => 28000.00,
            'wholesale_price' => max(18000.00, 28000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'OPP5',
            'name' => 'OPP 7X18',
            'unit' => 'PCS',
            'buy_price' => 3500.00,
            'sell_price' => 6500.00,
            'wholesale_price' => max(3500.00, 6500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_paper->id,
            'product_code' => 'PB',
            'name' => 'PAPER BOWL 500 ML',
            'unit' => 'PAK',
            'buy_price' => 14625.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(14625.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_paper->id,
            'product_code' => 'PB 2',
            'name' => 'PAPERBOWL 650ML',
            'unit' => 'PAK',
            'buy_price' => 13750.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(13750.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_pulpen->id,
            'product_code' => 'PEN 2',
            'name' => 'PULPEN LABUBU V2',
            'unit' => 'PCS',
            'buy_price' => 2708.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(2708.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_pulpen->id,
            'product_code' => 'PEN 3',
            'name' => 'PULPEN CRY BABY',
            'unit' => 'PCS',
            'buy_price' => 2708.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(2708.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_pensil->id,
            'product_code' => 'PEN 4',
            'name' => 'PENSIL KARAKTER',
            'unit' => 'PCS',
            'buy_price' => 2812.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2812.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_pensil->id,
            'product_code' => 'PENSIL',
            'name' => 'PENSIL MOTIF',
            'unit' => 'PCS',
            'buy_price' => 666.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(666.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_pensil->id,
            'product_code' => 'PENSIL1',
            'name' => 'PENSIL VOXY 2B',
            'unit' => 'PCS',
            'buy_price' => 600.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(600.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_pensil->id,
            'product_code' => 'PENSIL3',
            'name' => 'PENSIL 2B STAEDLER',
            'unit' => 'PCS',
            'buy_price' => 4166.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(4166.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PG 44',
            'name' => 'PLASTIK GELAS BAWANG PEX',
            'unit' => 'PAK',
            'buy_price' => 8700.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(8700.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PI 01',
            'name' => 'P. IDOLA 40',
            'unit' => 'PCS',
            'buy_price' => 10000.00,
            'sell_price' => 16000.00,
            'wholesale_price' => max(10000.00, 16000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PI 02',
            'name' => 'P. IDOLA 28',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 11000.00,
            'wholesale_price' => max(5000.00, 11000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PI 03',
            'name' => 'P. IDOLA 55',
            'unit' => 'PCS',
            'buy_price' => 35000.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(35000.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_piring->id,
            'product_code' => 'PIRING KERTAS',
            'name' => 'PIRING KERTAS KUE',
            'unit' => 'PAK',
            'buy_price' => 800.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(800.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL',
            'name' => 'PLASTIK KHARISMA HD UK24',
            'unit' => 'PCS',
            'buy_price' => 7500.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(7500.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 20',
            'name' => 'PLASTIK IDOLA 24',
            'unit' => 'PAK',
            'buy_price' => 12000.00,
            'sell_price' => 14000.00,
            'wholesale_price' => max(12000.00, 14000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 22',
            'name' => 'PLASTIK ULTAH SEDANG',
            'unit' => 'PAK',
            'buy_price' => 8000.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8000.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 23',
            'name' => 'PLASTIK ULTAH KECIL',
            'unit' => 'PAK',
            'buy_price' => 5000.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(5000.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 31',
            'name' => 'KILAT HITAM 28 CAP KUNING',
            'unit' => 'PCS',
            'buy_price' => 7825.00,
            'sell_price' => 11000.00,
            'wholesale_price' => max(7825.00, 11000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 33',
            'name' => 'PLASTIK MATAHARI 24',
            'unit' => 'PAK',
            'buy_price' => 2900.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(2900.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 34',
            'name' => 'PLASTIK ES BATU 10X35',
            'unit' => 'PCS',
            'buy_price' => 6500.00,
            'sell_price' => 8500.00,
            'wholesale_price' => max(6500.00, 8500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 48',
            'name' => 'PLASTIK SNACK IDUL FITRI',
            'unit' => 'PCS',
            'buy_price' => 10416.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(10416.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 55',
            'name' => 'PLASTIK NEMO 40',
            'unit' => 'PAK',
            'buy_price' => 8750.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8750.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 6',
            'name' => 'PLASTIK ES KERO',
            'unit' => 'PAK',
            'buy_price' => 4500.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(4500.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 65',
            'name' => 'PLASTIK ROL 02X60',
            'unit' => 'PAK',
            'buy_price' => 27000.00,
            'sell_price' => 32000.00,
            'wholesale_price' => max(27000.00, 32000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 66',
            'name' => 'PLASTIK ROL 02X50',
            'unit' => 'PAK',
            'buy_price' => 22500.00,
            'sell_price' => 28000.00,
            'wholesale_price' => max(22500.00, 28000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 67',
            'name' => 'PLASTIK ROL 02X40',
            'unit' => 'PAK',
            'buy_price' => 36000.00,
            'sell_price' => 42000.00,
            'wholesale_price' => max(36000.00, 42000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 68',
            'name' => 'PLASTIK ROL 02X35',
            'unit' => 'PAK',
            'buy_price' => 31500.00,
            'sell_price' => 38000.00,
            'wholesale_price' => max(31500.00, 38000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 69',
            'name' => 'PLASTIK ROL 02X30',
            'unit' => 'PAK',
            'buy_price' => 27000.00,
            'sell_price' => 32000.00,
            'wholesale_price' => max(27000.00, 32000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 81',
            'name' => 'PLASTIK SEGITIGA BESAR',
            'unit' => 'PAK',
            'buy_price' => 13500.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(13500.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 88',
            'name' => 'PLASTIK SEGITIGA KECIL',
            'unit' => 'PAK',
            'buy_price' => 9000.00,
            'sell_price' => 14000.00,
            'wholesale_price' => max(9000.00, 14000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL 89',
            'name' => 'PLASTIK ES BATU 9X35',
            'unit' => 'PAK',
            'buy_price' => 6500.00,
            'sell_price' => 8500.00,
            'wholesale_price' => max(6500.00, 8500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_origami->id,
            'product_code' => 'PL 90',
            'name' => 'P. BANDENG 40 HITAM',
            'unit' => 'PAK',
            'buy_price' => 6900.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(6900.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL1',
            'name' => 'PLASTIK BOLA LAMPU UK 35',
            'unit' => 'PCS',
            'buy_price' => 6400.00,
            'sell_price' => 11000.00,
            'wholesale_price' => max(6400.00, 11000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL10',
            'name' => 'PLASTIK KHARISMA UK 40',
            'unit' => 'PCS',
            'buy_price' => 12000.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(12000.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL11',
            'name' => 'PLASTIK KHARISMA HITAM UK 24',
            'unit' => 'PCS',
            'buy_price' => 3700.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3700.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL12',
            'name' => 'PLASTIK KILAT PUTIH UK 28 CAP KUNING',
            'unit' => 'PCS',
            'buy_price' => 7825.00,
            'sell_price' => 16000.00,
            'wholesale_price' => max(7825.00, 16000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL13',
            'name' => 'PLASTIK KILAT PUTIH UK 28 CAP MERAH',
            'unit' => 'PCS',
            'buy_price' => 9500.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(9500.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL14',
            'name' => 'PLASTIK GULA 12X24',
            'unit' => 'PCS',
            'buy_price' => 6200.00,
            'sell_price' => 8500.00,
            'wholesale_price' => max(6200.00, 8500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL15',
            'name' => 'PLASTIK GULA 13X31 KHARISMA',
            'unit' => 'PCS',
            'buy_price' => 6200.00,
            'sell_price' => 8500.00,
            'wholesale_price' => max(6200.00, 8500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL16',
            'name' => 'PLASTIK BOLA LAMPU UK 40',
            'unit' => 'PCS',
            'buy_price' => 8950.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(8950.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL17',
            'name' => 'PLASTIK KILAT HITAM CAP MERAH UK 28',
            'unit' => 'PAK',
            'buy_price' => 9450.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(9450.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL18',
            'name' => 'PLASTIK BAWANG BENING MERAH 15',
            'unit' => 'PAK',
            'buy_price' => 7500.00,
            'sell_price' => 11000.00,
            'wholesale_price' => max(7500.00, 11000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL19',
            'name' => 'PLASTIK TAHAN PANAS KHARISMA',
            'unit' => 'PCS',
            'buy_price' => 7900.00,
            'sell_price' => 13000.00,
            'wholesale_price' => max(7900.00, 13000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL2',
            'name' => 'PLASTIK JUMBO SERBA',
            'unit' => 'PCS',
            'buy_price' => 19000.00,
            'sell_price' => 30000.00,
            'wholesale_price' => max(19000.00, 30000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL20',
            'name' => 'PLASTIK ES BATU 8X35 KHARISMA',
            'unit' => 'PCS',
            'buy_price' => 6250.00,
            'sell_price' => 8500.00,
            'wholesale_price' => max(6250.00, 8500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL22',
            'name' => 'PLASTIK GELAS KHARISMA',
            'unit' => 'PCS',
            'buy_price' => 4000.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(4000.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL23',
            'name' => 'PLASTIK ECER',
            'unit' => 'PCS',
            'buy_price' => 500.00,
            'sell_price' => 1000.00,
            'wholesale_price' => max(500.00, 1000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL24',
            'name' => 'PLASTIK KHARISMA',
            'unit' => 'DUS',
            'buy_price' => 7350.00,
            'sell_price' => 11000.00,
            'wholesale_price' => max(7350.00, 11000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL28',
            'name' => 'PLASTIK KHARISMA HD UK15',
            'unit' => 'PCS',
            'buy_price' => 7500.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(7500.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL29',
            'name' => 'PLASTIK LIMAU KUIT',
            'unit' => 'PCS',
            'buy_price' => 1800.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(1800.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL3',
            'name' => 'PLASTIK JUMBO KHARISMA',
            'unit' => 'PCS',
            'buy_price' => 42000.00,
            'sell_price' => 50000.00,
            'wholesale_price' => max(42000.00, 50000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL30',
            'name' => 'PLASTIK DUA KELINCI PUTIH 15',
            'unit' => 'PCS',
            'buy_price' => 1250.00,
            'sell_price' => 2500.00,
            'wholesale_price' => max(1250.00, 2500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL31',
            'name' => 'PLASTIK BAWANG BENING 24',
            'unit' => 'PCS',
            'buy_price' => 7500.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(7500.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL32',
            'name' => 'PLASTIK KHARISMA 25',
            'unit' => 'PCS',
            'buy_price' => 7000.00,
            'sell_price' => 11000.00,
            'wholesale_price' => max(7000.00, 11000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL33',
            'name' => 'PLASTIK TERIMA KASIH WARNA WARNI',
            'unit' => 'PCS',
            'buy_price' => 6500.00,
            'sell_price' => 8500.00,
            'wholesale_price' => max(6500.00, 8500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL34',
            'name' => 'PLASTIK BAWANG GELAS',
            'unit' => 'PCS',
            'buy_price' => 8500.00,
            'sell_price' => 13000.00,
            'wholesale_price' => max(8500.00, 13000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL35',
            'name' => 'PLASTIK KILAT PUTIH 15',
            'unit' => 'PCS',
            'buy_price' => 3200.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(3200.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL36',
            'name' => 'PLASTIK KILAT PUTIH 35',
            'unit' => 'PCS',
            'buy_price' => 15500.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(15500.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL4',
            'name' => 'PLASTIK FUTSAL 1/2 KG',
            'unit' => 'PCS',
            'buy_price' => 2025.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2025.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL44 ECER',
            'name' => 'PLASTIK JUMBO ECER',
            'unit' => 'PCS',
            'buy_price' => 1300.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(1300.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL5',
            'name' => 'PLASTIK FUTSAL 1/4 KG',
            'unit' => 'PCS',
            'buy_price' => 955.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(955.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL55 ECER',
            'name' => 'JUMBO KHARISMA ECER',
            'unit' => 'PCS',
            'buy_price' => 1923.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(1923.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL6',
            'name' => 'PLASTIK KHARISMA BIRU BENING UK 15',
            'unit' => 'PCS',
            'buy_price' => 2550.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(2550.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL7',
            'name' => 'PLASTIK KHARISMA HIJAU BENING UK 15',
            'unit' => 'PCS',
            'buy_price' => 2100.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2100.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL8',
            'name' => 'PLASTIK KHARISMA UNGU BENING UK 15',
            'unit' => 'PCS',
            'buy_price' => 1750.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(1750.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PL9',
            'name' => 'PLASTIK KILAT HITAM 15',
            'unit' => 'PCS',
            'buy_price' => 3200.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(3200.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_pulpen->id,
            'product_code' => 'PLN 21',
            'name' => 'PULPEN PILOT',
            'unit' => 'PCS',
            'buy_price' => 1500.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(1500.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PLS 30',
            'name' => 'P. BENDENG HITAM 40',
            'unit' => 'PCS',
            'buy_price' => 6900.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(6900.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_piring->id,
            'product_code' => 'PP',
            'name' => 'PIRING PLASTIK KECIL',
            'unit' => 'PAK',
            'buy_price' => 8375.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(8375.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_piring->id,
            'product_code' => 'PP 1',
            'name' => 'PIRING KERTAS OKKY',
            'unit' => 'PAK',
            'buy_price' => 15000.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(15000.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_piring->id,
            'product_code' => 'PP 2',
            'name' => 'PIRING BESAR',
            'unit' => 'PAK',
            'buy_price' => 25500.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(25500.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_piring->id,
            'product_code' => 'PP 34',
            'name' => 'PIRING SEDANG',
            'unit' => 'PAK',
            'buy_price' => 14000.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(14000.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PPB',
            'name' => 'PLASTIK PEX BAWANG UK 25',
            'unit' => 'PCS',
            'buy_price' => 8150.00,
            'sell_price' => 16000.00,
            'wholesale_price' => max(8150.00, 16000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PPB1',
            'name' => 'PLASTIK PEX BAWANG UK 20',
            'unit' => 'PCS',
            'buy_price' => 8150.00,
            'sell_price' => 16000.00,
            'wholesale_price' => max(8150.00, 16000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PPB2',
            'name' => 'PLASTIK PEX BAWANG UK 15',
            'unit' => 'PCS',
            'buy_price' => 8300.00,
            'sell_price' => 16000.00,
            'wholesale_price' => max(8300.00, 16000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PPB3',
            'name' => 'PLASTIK BAWANG PEX UK 30',
            'unit' => 'PCS',
            'buy_price' => 16200.00,
            'sell_price' => 22000.00,
            'wholesale_price' => max(16200.00, 22000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_piring->id,
            'product_code' => 'PPL 33',
            'name' => 'PLATE 18',
            'unit' => 'PAK',
            'buy_price' => 16250.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(16250.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PS',
            'name' => 'OPTIMA 100X120',
            'unit' => 'PCS',
            'buy_price' => 15750.00,
            'sell_price' => 25000.00,
            'wholesale_price' => max(15750.00, 25000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PS 09',
            'name' => 'KHARISMA 60X100',
            'unit' => 'PAK',
            'buy_price' => 7666.00,
            'sell_price' => 17000.00,
            'wholesale_price' => max(7666.00, 17000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PS 10',
            'name' => 'KHARISMA 80X100',
            'unit' => 'PAK',
            'buy_price' => 11071.00,
            'sell_price' => 17000.00,
            'wholesale_price' => max(11071.00, 17000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PS 44',
            'name' => 'P.SAMPAH 60X100',
            'unit' => 'PAK',
            'buy_price' => 7666.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(7666.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_pulpen->id,
            'product_code' => 'PS 55',
            'name' => 'P.SAMPAH 80X100',
            'unit' => 'PAK',
            'buy_price' => 11071.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(11071.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PS 77',
            'name' => 'OPTIMA ECER',
            'unit' => 'PCS',
            'buy_price' => 1210.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(1210.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PS1',
            'name' => 'OPTIMA 90X120',
            'unit' => 'PCS',
            'buy_price' => 8750.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(8750.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PS2',
            'name' => 'OPTIMA 80X100',
            'unit' => 'PCS',
            'buy_price' => 12100.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(12100.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PS3',
            'name' => 'OPTIMA 60X100',
            'unit' => 'PCS',
            'buy_price' => 9100.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(9100.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PTP 33',
            'name' => 'PLASTIK KHARISMA TAHAN PANAS KECIL',
            'unit' => 'PAK',
            'buy_price' => 8000.00,
            'sell_price' => 13000.00,
            'wholesale_price' => max(8000.00, 13000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PTP 34',
            'name' => 'PLASTIK KHARISMA TAHAN PANAS SEDANG',
            'unit' => 'PAK',
            'buy_price' => 8000.00,
            'sell_price' => 13000.00,
            'wholesale_price' => max(8000.00, 13000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PTP 35',
            'name' => 'PLASTIK KHARISMA TAHAN PANAS BESAR',
            'unit' => 'PAK',
            'buy_price' => 9500.00,
            'sell_price' => 13000.00,
            'wholesale_price' => max(9500.00, 13000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_pulpen->id,
            'product_code' => 'PULPEN',
            'name' => 'PULPEN LABUBU',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(5000.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PY 1',
            'name' => 'POLYMAILER 25X35',
            'unit' => 'PAK',
            'buy_price' => 37000.00,
            'sell_price' => 45000.00,
            'wholesale_price' => max(37000.00, 45000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PY 2',
            'name' => 'POLYMAILER 20X30',
            'unit' => 'PAK',
            'buy_price' => 26000.00,
            'sell_price' => 34000.00,
            'wholesale_price' => max(26000.00, 34000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'PY 3',
            'name' => 'POLYMAITER 17X30',
            'unit' => 'PAK',
            'buy_price' => 24000.00,
            'sell_price' => 32000.00,
            'wholesale_price' => max(24000.00, 32000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_rautan->id,
            'product_code' => 'RAUTAN',
            'name' => 'RAUTAN SUNWELL',
            'unit' => 'PCS',
            'buy_price' => 666.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(666.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_rautan->id,
            'product_code' => 'RAUTAN1',
            'name' => 'RAUTAN OVAL',
            'unit' => 'PCS',
            'buy_price' => 625.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(625.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_rautan->id,
            'product_code' => 'RAUTAN2',
            'name' => 'RAUTAN MOBIL',
            'unit' => 'PCS',
            'buy_price' => 625.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(625.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sabun->id,
            'product_code' => 'S1',
            'name' => 'SUNLIGHT PINK',
            'unit' => 'PCS',
            'buy_price' => 15000.00,
            'sell_price' => 16500.00,
            'wholesale_price' => max(15000.00, 16500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sabun->id,
            'product_code' => 'S2',
            'name' => 'GENTLEGEN PINK BOTOL',
            'unit' => 'PCS',
            'buy_price' => 19000.00,
            'sell_price' => 22000.00,
            'wholesale_price' => max(19000.00, 22000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sedotan->id,
            'product_code' => 'SD',
            'name' => 'SEDOTAN HITAM STERIL PLASTIK',
            'unit' => 'PAK',
            'buy_price' => 10750.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(10750.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sedotan->id,
            'product_code' => 'SD 3',
            'name' => 'SEDOTAN HITAM STERIL PLASTIK BANYAK',
            'unit' => 'PAK',
            'buy_price' => 20000.00,
            'sell_price' => 28000.00,
            'wholesale_price' => max(20000.00, 28000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sedotan->id,
            'product_code' => 'SD1',
            'name' => 'SEDOTAN PUTIH STERIL KERTAS',
            'unit' => 'PAK',
            'buy_price' => 26000.00,
            'sell_price' => 38000.00,
            'wholesale_price' => max(26000.00, 38000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sedotan->id,
            'product_code' => 'SD2',
            'name' => 'SEDOTAN PUTIH BENGKOK RUBY',
            'unit' => 'PAK',
            'buy_price' => 8200.00,
            'sell_price' => 13000.00,
            'wholesale_price' => max(8200.00, 13000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sedotan->id,
            'product_code' => 'SD3',
            'name' => 'SEDOTAN WARNA WARNI',
            'unit' => 'PAK',
            'buy_price' => 2950.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2950.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sedotan->id,
            'product_code' => 'SD4',
            'name' => 'SEDOTAN BUBBLE BIASA',
            'unit' => 'PAK',
            'buy_price' => 2950.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(2950.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sedotan->id,
            'product_code' => 'SD5',
            'name' => 'SEDOTAN HITAM STERIL KERTAS',
            'unit' => 'PAK',
            'buy_price' => 26000.00,
            'sell_price' => 38000.00,
            'wholesale_price' => max(26000.00, 38000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sedotan->id,
            'product_code' => 'SD6',
            'name' => 'SEDOTAN BUBBLE STERIL',
            'unit' => 'PAK',
            'buy_price' => 10200.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(10200.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sedotan->id,
            'product_code' => 'SD7',
            'name' => 'SEDOTAN HITAM CANTIK',
            'unit' => 'PAK',
            'buy_price' => 8750.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8750.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendal->id,
            'product_code' => 'SDL 1',
            'name' => 'SENDAL JAPIT',
            'unit' => 'PCS',
            'buy_price' => 12000.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(12000.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'SEAL CUP',
            'name' => 'SEAL CUP BENING',
            'unit' => 'PCS',
            'buy_price' => 26250.00,
            'sell_price' => 45000.00,
            'wholesale_price' => max(26250.00, 45000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SEN 45',
            'name' => 'SENDOK DUS',
            'unit' => 'DUS',
            'buy_price' => 195000.00,
            'sell_price' => 260000.00,
            'wholesale_price' => max(195000.00, 260000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SM',
            'name' => 'SENDOK MAKAN',
            'unit' => 'PAK',
            'buy_price' => 8000.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(8000.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SM 43',
            'name' => 'GARPU BENING ISI 50',
            'unit' => 'PAK',
            'buy_price' => 9000.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(9000.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SM2',
            'name' => 'SENDOK GARPU',
            'unit' => 'PAK',
            'buy_price' => 10000.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(10000.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sandal->id,
            'product_code' => 'SN',
            'name' => 'SANDAL NIPPON',
            'unit' => 'PCS',
            'buy_price' => 8666.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8666.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_garfu->id,
            'product_code' => 'SN 34',
            'name' => 'GARPU',
            'unit' => 'PAK',
            'buy_price' => 13375.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(13375.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SND 04',
            'name' => 'SENDOK JELLY VICTORY',
            'unit' => 'PAK',
            'buy_price' => 4300.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(4300.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendal->id,
            'product_code' => 'SND 1',
            'name' => 'SENDAL ANAK-ANAK',
            'unit' => 'PCS',
            'buy_price' => 3500.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(3500.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SND 34',
            'name' => 'SENDOK TEH',
            'unit' => 'PAK',
            'buy_price' => 7250.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(7250.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SND 66',
            'name' => 'SENDOK BEBEK BENING',
            'unit' => 'PAK',
            'buy_price' => 5500.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(5500.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SND 87',
            'name' => 'SENDOK TISU',
            'unit' => 'PAK',
            'buy_price' => 24500.00,
            'sell_price' => 30000.00,
            'wholesale_price' => max(24500.00, 30000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SND ECER 88',
            'name' => 'SENDOK TISU ECER',
            'unit' => 'PCS',
            'buy_price' => 245.00,
            'sell_price' => 500.00,
            'wholesale_price' => max(245.00, 500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'SO',
            'name' => 'SHD OVAL 20X30 HELLO KITTY',
            'unit' => 'PAK',
            'buy_price' => 22000.00,
            'sell_price' => 28000.00,
            'wholesale_price' => max(22000.00, 28000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'SP 21',
            'name' => 'SP SEAL LEBAR 9X15',
            'unit' => 'PAK',
            'buy_price' => 7800.00,
            'sell_price' => 14000.00,
            'wholesale_price' => max(7800.00, 14000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'SP 22',
            'name' => 'SP SEAL BIASA 10X17',
            'unit' => 'PAK',
            'buy_price' => 10250.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(10250.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'SP 33',
            'name' => 'SEAL CUP NAWA',
            'unit' => 'PAK',
            'buy_price' => 33500.00,
            'sell_price' => 65000.00,
            'wholesale_price' => max(33500.00, 65000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_alat->id,
            'product_code' => 'SPLS 22',
            'name' => 'STAPLES BESAR 369',
            'unit' => 'PCS',
            'buy_price' => 2250.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(2250.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sendok->id,
            'product_code' => 'SPT 34',
            'name' => 'SUMPIT',
            'unit' => 'PAK',
            'buy_price' => 6000.00,
            'sell_price' => 8500.00,
            'wholesale_price' => max(6000.00, 8500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_sarung_tangan->id,
            'product_code' => 'ST',
            'name' => 'SARUNG TANGAN KHARISMA',
            'unit' => 'PCS',
            'buy_price' => 15200.00,
            'sell_price' => 17000.00,
            'wholesale_price' => max(15200.00, 17000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_stiker->id,
            'product_code' => 'ST 12',
            'name' => 'STIKER SANRIO',
            'unit' => 'PCS',
            'buy_price' => 3000.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3000.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_stapler->id,
            'product_code' => 'ST 54',
            'name' => 'ISI STAPLES NO.3 KENKO',
            'unit' => 'PAK',
            'buy_price' => 5000.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(5000.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_stapler->id,
            'product_code' => 'STAPLER',
            'name' => 'STAPLER MAX HD-10D',
            'unit' => 'PCS',
            'buy_price' => 37000.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(37000.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_stapler->id,
            'product_code' => 'STAPLER1',
            'name' => 'STAPLER MAX HD 10 MAGENTA',
            'unit' => 'PCS',
            'buy_price' => 18500.00,
            'sell_price' => 22000.00,
            'wholesale_price' => max(18500.00, 22000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_stapler->id,
            'product_code' => 'STAPLER2',
            'name' => 'STAPLER MAX HD 10 MAGENTA',
            'unit' => 'PCS',
            'buy_price' => 59000.00,
            'sell_price' => 65000.00,
            'wholesale_price' => max(59000.00, 65000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_stiker->id,
            'product_code' => 'STIKER',
            'name' => 'STIKER',
            'unit' => 'PCS',
            'buy_price' => 2250.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2250.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 5,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'STP 1',
            'name' => 'STP 9X15 S LEBAR',
            'unit' => 'PAK',
            'buy_price' => 8000.00,
            'sell_price' => 14000.00,
            'wholesale_price' => max(8000.00, 14000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'STP 2',
            'name' => 'STP 10X17 S LEBAR',
            'unit' => 'PAK',
            'buy_price' => 10500.00,
            'sell_price' => 16000.00,
            'wholesale_price' => max(10500.00, 16000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'STP 3',
            'name' => 'STP 14X22 S LEBAR',
            'unit' => 'PAK',
            'buy_price' => 19000.00,
            'sell_price' => 26000.00,
            'wholesale_price' => max(19000.00, 26000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'STP 4',
            'name' => 'STP 16X24 S LEBAR',
            'unit' => 'PAK',
            'buy_price' => 27000.00,
            'sell_price' => 32000.00,
            'wholesale_price' => max(27000.00, 32000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'STP 5',
            'name' => 'STP 16X32 S LEBAR',
            'unit' => 'PAK',
            'buy_price' => 34500.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(34500.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'STP 6',
            'name' => 'STP 20X29 S LEBAR',
            'unit' => 'PAK',
            'buy_price' => 43000.00,
            'sell_price' => 48000.00,
            'wholesale_price' => max(43000.00, 48000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tali->id,
            'product_code' => 'TALI',
            'name' => 'TALI RAPIA 1 KG',
            'unit' => 'PCS',
            'buy_price' => 16500.00,
            'sell_price' => 20000.00,
            'wholesale_price' => max(16500.00, 20000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tali->id,
            'product_code' => 'TALI1',
            'name' => 'TALI RAPIA 1/2  KG',
            'unit' => 'PCS',
            'buy_price' => 8500.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8500.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tali->id,
            'product_code' => 'TALI2',
            'name' => 'TALI RAPIA 1/4  KG',
            'unit' => 'PCS',
            'buy_price' => 6250.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(6250.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_botol->id,
            'product_code' => 'TB 1',
            'name' => 'TABUNG 1500 ML',
            'unit' => 'PCS',
            'buy_price' => 3000.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(3000.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_toples->id,
            'product_code' => 'TB 2',
            'name' => 'TOPLES 300 ML',
            'unit' => 'PCS',
            'buy_price' => 2700.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2700.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_toples->id,
            'product_code' => 'TB 3',
            'name' => 'TOPLES 500 ML',
            'unit' => 'PCS',
            'buy_price' => 2700.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(2700.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_toples->id,
            'product_code' => 'TB 4',
            'name' => 'TOPLES  600 ML',
            'unit' => 'PCS',
            'buy_price' => 2700.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(2700.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tutup->id,
            'product_code' => 'TC',
            'name' => 'TUTUP CEMBUNG STARINDO',
            'unit' => 'PAK',
            'buy_price' => 5625.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(5625.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tutup->id,
            'product_code' => 'TC 5',
            'name' => 'TUTUP CEMBUNG BESAR',
            'unit' => 'PAK',
            'buy_price' => 8250.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(8250.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tutup->id,
            'product_code' => 'TD',
            'name' => 'TUTUP DATAR BIASA',
            'unit' => 'PAK',
            'buy_price' => 3000.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(3000.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_air->id,
            'product_code' => 'TEH 1',
            'name' => 'TEH PUCUK',
            'unit' => 'PCS',
            'buy_price' => 6000.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(6000.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tusuk->id,
            'product_code' => 'TG',
            'name' => 'TUSUK GIGI CHERIA STERIIL',
            'unit' => 'PAK',
            'buy_price' => 11500.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(11500.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS',
            'name' => 'TISSUE JOLLY POP UP',
            'unit' => 'PCS',
            'buy_price' => 2700.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2700.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS 45',
            'name' => 'PASEO SMART FACIAL',
            'unit' => 'PAK',
            'buy_price' => 5416.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(5416.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS1',
            'name' => 'TISSUE PASEO 250 GR',
            'unit' => 'PCS',
            'buy_price' => 9583.00,
            'sell_price' => 14000.00,
            'wholesale_price' => max(9583.00, 14000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS10',
            'name' => 'TISSUE MAKAN MURAH',
            'unit' => 'PCS',
            'buy_price' => 1500.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(1500.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS2',
            'name' => 'TISSUE BASAH',
            'unit' => 'PCS',
            'buy_price' => 11000.00,
            'sell_price' => 14000.00,
            'wholesale_price' => max(11000.00, 14000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS3',
            'name' => 'TISSUE TOPLY',
            'unit' => 'PCS',
            'buy_price' => 3700.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(3700.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS4',
            'name' => 'TISSUE NICE 250GR',
            'unit' => 'PCS',
            'buy_price' => 7875.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(7875.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS5',
            'name' => 'TISSUE PASEO KECIL',
            'unit' => 'PCS',
            'buy_price' => 3340.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3340.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS6',
            'name' => 'TISSUE NICE KECIL',
            'unit' => 'PCS',
            'buy_price' => 6116.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(6116.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS7',
            'name' => 'TISSUE JOLLY 250 GR',
            'unit' => 'PCS',
            'buy_price' => 7208.00,
            'sell_price' => 11000.00,
            'wholesale_price' => max(7208.00, 11000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS8',
            'name' => 'TISSUE JOLLY KULINER',
            'unit' => 'PCS',
            'buy_price' => 9250.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(9250.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TIS9',
            'name' => 'JOLLY SEDANG',
            'unit' => 'PAK',
            'buy_price' => 15000.00,
            'sell_price' => 17500.00,
            'wholesale_price' => max(15000.00, 17500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TISU 44',
            'name' => 'TISU MONTISS 250',
            'unit' => 'PAK',
            'buy_price' => 7500.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(7500.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TK',
            'name' => 'TAS KAIN 30X13',
            'unit' => 'PAK',
            'buy_price' => 29508.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(29508.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TK Smart',
            'name' => 'Tisu Karakter Mini SMART',
            'unit' => 'PAK',
            'buy_price' => 10000.00,
            'sell_price' => 15500.00,
            'wholesale_price' => max(10000.00, 15500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TK Soft',
            'name' => 'Tisu Karakter Mini T-Soft',
            'unit' => 'PAK',
            'buy_price' => 4000.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(4000.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TK1',
            'name' => 'TAS KAIN 33X13',
            'unit' => 'PAK',
            'buy_price' => 27540.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(27540.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TK2',
            'name' => 'TAS KAIN KOTAK',
            'unit' => 'PAK',
            'buy_price' => 19668.00,
            'sell_price' => 30000.00,
            'wholesale_price' => max(19668.00, 30000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TN 99',
            'name' => 'TAS KAIN 33X13 ECER',
            'unit' => 'PCS',
            'buy_price' => 2295.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2295.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_toples->id,
            'product_code' => 'TOPLES 01',
            'name' => 'TOPLES 400 ML',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(5000.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_toples->id,
            'product_code' => 'TOPLES 04',
            'name' => 'TOPLES 800 ML',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 7500.00,
            'wholesale_price' => max(5000.00, 7500.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_toples->id,
            'product_code' => 'TOPLES 05',
            'name' => 'TOPLES 1000 ML',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(5000.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tusuk->id,
            'product_code' => 'TP',
            'name' => 'TUSUK PENTOL',
            'unit' => 'PAK',
            'buy_price' => 3100.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3100.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tutup->id,
            'product_code' => 'TP 23',
            'name' => 'TUTUP KOPI',
            'unit' => 'PAK',
            'buy_price' => 8750.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8750.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_toples->id,
            'product_code' => 'TP 6',
            'name' => 'TOPLES RAYA ECER',
            'unit' => 'PCS',
            'buy_price' => 3000.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3000.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tutup->id,
            'product_code' => 'TPB',
            'name' => 'TUTUP PAPER BOWL 500 ML',
            'unit' => 'PAK',
            'buy_price' => 5175.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(5175.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TPL 1',
            'name' => 'TOPLY DUS',
            'unit' => 'PAK',
            'buy_price' => 216000.00,
            'sell_price' => 260000.00,
            'wholesale_price' => max(216000.00, 260000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TS 12',
            'name' => 'PAPERBAG LABUBU',
            'unit' => 'PCS',
            'buy_price' => 6600.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(6600.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TS 13',
            'name' => 'PAPAERBAG MOTIF',
            'unit' => 'PCS',
            'buy_price' => 5833.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(5833.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TS 18',
            'name' => 'TAS KAIN KECIL ECER',
            'unit' => 'PCS',
            'buy_price' => 1000.00,
            'sell_price' => 2000.00,
            'wholesale_price' => max(1000.00, 2000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TS 2',
            'name' => 'PAPERBAG KIKY',
            'unit' => 'PCS',
            'buy_price' => 8000.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8000.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TS 21',
            'name' => 'TISU KARAKTER',
            'unit' => 'PAK',
            'buy_price' => 15000.00,
            'sell_price' => 22000.00,
            'wholesale_price' => max(15000.00, 22000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TS 22',
            'name' => 'TISU BASAH KARAKTER',
            'unit' => 'PCS',
            'buy_price' => 2500.00,
            'sell_price' => 3000.00,
            'wholesale_price' => max(2500.00, 3000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TS 31',
            'name' => 'TISU T-SOFT',
            'unit' => 'PAK',
            'buy_price' => 7000.00,
            'sell_price' => 9000.00,
            'wholesale_price' => max(7000.00, 9000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TS 32',
            'name' => 'TAS TRANSPARANT L',
            'unit' => 'PCS',
            'buy_price' => 8750.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8750.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TS 33',
            'name' => 'TAS TRANSPARANT M',
            'unit' => 'PCS',
            'buy_price' => 7000.00,
            'sell_price' => 10000.00,
            'wholesale_price' => max(7000.00, 10000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TS 60',
            'name' => 'TISU WASTAFEL',
            'unit' => 'PCS',
            'buy_price' => 10500.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(10500.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tissue->id,
            'product_code' => 'TS 65',
            'name' => 'TISU SEE U POP UP',
            'unit' => 'PCS',
            'buy_price' => 2084.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(2084.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TS 66',
            'name' => 'TAS IDUL FITRI SEDANG',
            'unit' => 'PCS',
            'buy_price' => 13333.00,
            'sell_price' => 18000.00,
            'wholesale_price' => max(13333.00, 18000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TS 67',
            'name' => 'TAS IDUL FITRI KECIL',
            'unit' => 'PCS',
            'buy_price' => 10833.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(10833.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TS 68',
            'name' => 'TAS IDUL FITRI BESAR',
            'unit' => 'PCS',
            'buy_price' => 5000.00,
            'sell_price' => 8000.00,
            'wholesale_price' => max(5000.00, 8000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tusuk->id,
            'product_code' => 'TSK 4',
            'name' => 'TUSUK SATE',
            'unit' => 'PAK',
            'buy_price' => 11500.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(11500.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tusuk->id,
            'product_code' => 'TSK 5',
            'name' => 'TUSUK SATE SEDIKIT',
            'unit' => 'PCS',
            'buy_price' => 3500.00,
            'sell_price' => 6000.00,
            'wholesale_price' => max(3500.00, 6000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tusuk->id,
            'product_code' => 'TSK 6',
            'name' => 'TUSUK GIGI',
            'unit' => 'PAK',
            'buy_price' => 3500.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(3500.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tusuk->id,
            'product_code' => 'TSK 7',
            'name' => 'TUSUK GIGI BOTOL',
            'unit' => 'PAK',
            'buy_price' => 2700.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2700.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TSK 71',
            'name' => 'TAS KAIN IDUL FITRI 30X13',
            'unit' => 'PAK',
            'buy_price' => 30156.00,
            'sell_price' => 40000.00,
            'wholesale_price' => max(30156.00, 40000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TSK 72',
            'name' => 'TAS KAIN IDUL FITRI 30X9',
            'unit' => 'PAK',
            'buy_price' => 25308.00,
            'sell_price' => 30000.00,
            'wholesale_price' => max(25308.00, 30000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_stik->id,
            'product_code' => 'TSK 8',
            'name' => 'STIK ES KRIM',
            'unit' => 'PAK',
            'buy_price' => 12000.00,
            'sell_price' => 15000.00,
            'wholesale_price' => max(12000.00, 15000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TSK ECER 73',
            'name' => 'TAS KAIN IDUL FITRI 30X13',
            'unit' => 'PCS',
            'buy_price' => 2929.00,
            'sell_price' => 5000.00,
            'wholesale_price' => max(2929.00, 5000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tas->id,
            'product_code' => 'TSK ECER 74',
            'name' => 'TAS KAIN IDUL FITRI 30X9',
            'unit' => 'PCS',
            'buy_price' => 2109.00,
            'sell_price' => 4000.00,
            'wholesale_price' => max(2109.00, 4000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tutup->id,
            'product_code' => 'TTP 65',
            'name' => 'TUTUP RICE BOWL 650ML',
            'unit' => 'PCS',
            'buy_price' => 8500.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8500.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tutup->id,
            'product_code' => 'TTP 69',
            'name' => 'TUTUP DATAR IMP',
            'unit' => 'PAK',
            'buy_price' => 8550.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(8550.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_tutup->id,
            'product_code' => 'TTPD',
            'name' => 'TUTUP DATAR STARINDO',
            'unit' => 'PAK',
            'buy_price' => 4625.00,
            'sell_price' => 12000.00,
            'wholesale_price' => max(4625.00, 12000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);

        Product::create([
            'category_id' => $cat_plastik->id,
            'product_code' => 'WP 01',
            'name' => 'WRAPPING CHEPPY 40',
            'unit' => 'PCS',
            'buy_price' => 59000.00,
            'sell_price' => 145000.00,
            'wholesale_price' => max(59000.00, 145000.00 * 0.998),
            'wholesale_min_qty' => 10,
            'stock' => 100,
            'min_stock' => 5,
        ]);


        // 4. Seed Shop Settings
        Setting::setValue('shop_name', 'BAUNTUNGPOS');
        Setting::setValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO');
        Setting::setValue('shop_address', 'Jl. Panglima Batur, Komet, Kec. Banjarbaru Utara, Kota Banjar Baru, Kalimantan Selatan 70714');
        Setting::setValue('shop_phone', '0851 6665 7171');
        Setting::setValue('shop_receipt_footer', "Terimakasih atas Kunjungan Anda\nBarang yang sudah dibeli\ntidak dapat ditukar/dikembalikan");

        // 5. Clean up and group products into the 7 standard categories
        $this->command->info('Running products:clean to align categories and codes...');
        \Illuminate\Support\Facades\Artisan::call('products:clean');
    }
}