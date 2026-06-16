<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ITController extends Controller
{
    /**
     * Dashboard IT Admin.
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $totalTransactions = Transaction::count();

        // Get MySQL database size
        $database = env('DB_DATABASE', 'tokobauntung');
        $dbSize = 0;
        try {
            $result = \Illuminate\Support\Facades\DB::select("
                SELECT SUM(data_length + index_length) AS size 
                FROM information_schema.TABLES 
                WHERE table_schema = ?
            ", [$database]);
            $dbSize = $result[0]->size ?? 0;
        } catch (\Exception $e) {
            // fallback
        }
        
        // Format size
        if ($dbSize >= 1048576) {
            $dbSizeStr = number_format($dbSize / 1048576, 2) . ' MB';
        } elseif ($dbSize >= 1024) {
            $dbSizeStr = number_format($dbSize / 1024, 2) . ' KB';
        } else {
            $dbSizeStr = $dbSize . ' bytes';
        }

        // Recent users logged in or registered
        $recentUsers = User::orderBy('id', 'desc')->take(5)->get();

        return view('it.dashboard', compact('totalUsers', 'activeUsers', 'totalTransactions', 'dbSizeStr', 'recentUsers'));
    }

    /**
     * Manajemen User: Daftar, Tambah, Edit, Aktivasi.
     */
    public function users()
    {
        $users = User::orderBy('id', 'asc')->get();
        return view('it.users', compact('users'));
    }

    /**
     * Menyimpan user baru.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:100',
            'email' => 'nullable|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin_kasir,keuangan,admin_it',
        ], [
            'username.unique' => 'Username sudah terpakai.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('it.users')->with('success', 'User baru berhasil dibuat.');
    }

    /**
     * Memperbarui user (termasuk reset password jika diisi).
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin_kasir,keuangan,admin_it',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('it.users')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Toggle status aktif/nonaktif user.
     */
    public function toggleUser($id)
    {
        $user = User::findOrFail($id);

        // Mencegah IT Admin menonaktifkan dirinya sendiri
        if ($user->id === Auth::id()) {
            return redirect()->route('it.users')->withErrors(['toggle' => 'Anda tidak bisa menonaktifkan akun Anda sendiri!']);
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        $statusStr = $user->is_active ? 'DIAKTIFKAN' : 'DINONAKTIFKAN';

        return redirect()->route('it.users')->with('success', "Akun {$user->name} berhasil {$statusStr}.");
    }

    /**
     * Pengaturan Profil Toko & Sistem.
     */
    public function settings()
    {
        $settings = [
            'shop_name' => Setting::getValue('shop_name', 'BAUNTUNGPOS'),
            'shop_subtitle' => Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO'),
            'shop_address' => Setting::getValue('shop_address', ''),
            'shop_phone' => Setting::getValue('shop_phone', ''),
            'shop_receipt_footer' => Setting::getValue('shop_receipt_footer', "Terimakasih atas Kunjungan Anda\nBarang yang sudah dibeli\ntidak dapat ditukar/dikembalikan"),
            'printer_chars_per_line' => Setting::getValue('printer_chars_per_line', '32'),
        ];

        return view('it.settings', compact('settings'));
    }

    /**
     * Menyimpan Pengaturan Toko.
     */
    public function saveSettings(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:100',
            'shop_subtitle' => 'required|string|max:100',
            'shop_address' => 'required|string',
            'shop_phone' => 'required|string',
            'shop_receipt_footer' => 'required|string',
            'printer_chars_per_line' => 'required|in:32,38',
        ]);

        Setting::setValue('shop_name', $request->shop_name);
        Setting::setValue('shop_subtitle', $request->shop_subtitle);
        Setting::setValue('shop_address', $request->shop_address);
        Setting::setValue('shop_phone', $request->shop_phone);
        Setting::setValue('shop_receipt_footer', $request->shop_receipt_footer);
        Setting::setValue('printer_chars_per_line', $request->printer_chars_per_line);

        return redirect()->route('it.settings')->with('success', 'Pengaturan profil toko berhasil diperbarui.');
    }

    /**
     * Backup Database MySQL (REQ-020).
     */
    public function backup()
    {
        $database = env('DB_DATABASE', 'tokobauntung');
        $username = env('DB_USERNAME', 'root');
        $password = env('DB_PASSWORD', '');
        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3306');
        
        $filename = 'backup_' . $database . '_' . date('Y-m-d_H-i-s') . '.sql';
        $tempFile = tempnam(sys_get_temp_dir(), 'backup_');
        
        // Path to Laragon's mysqldump
        $mysqldumpPath = 'C:/laragon/bin/mysql/mysql-8.0.30-winx64/bin/mysqldump.exe';
        if (!file_exists($mysqldumpPath)) {
            $mysqldumpPath = 'mysqldump'; // fallback to environment PATH
        }
        
        $cmd = sprintf(
            '"%s" --host=%s --port=%s --user=%s %s %s > "%s"',
            $mysqldumpPath,
            $host,
            $port,
            $username,
            $password ? '--password=' . $password : '',
            $database,
            $tempFile
        );
        
        exec($cmd, $output, $returnVar);
        
        if ($returnVar !== 0) {
            return redirect()->back()->withErrors(['error' => 'Gagal membuat backup database. Pastikan MySQL terpasang dan dapat diakses.']);
        }
        
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    /**
     * Restore Database MySQL (REQ-020).
     */
    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file',
        ]);
        
        $file = $request->file('backup_file');
        
        // Validasi ekstensi
        if ($file->getClientOriginalExtension() !== 'sql') {
            return redirect()->back()->withErrors(['backup_file' => 'Berkas cadangan harus berupa file dengan format .sql']);
        }
        
        $database = env('DB_DATABASE', 'tokobauntung');
        $username = env('DB_USERNAME', 'root');
        $password = env('DB_PASSWORD', '');
        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3306');
        
        // Path to Laragon's mysql CLI
        $mysqlPath = 'C:/laragon/bin/mysql/mysql-8.0.30-winx64/bin/mysql.exe';
        if (!file_exists($mysqlPath)) {
            $mysqlPath = 'mysql'; // fallback to environment PATH
        }
        
        $cmd = sprintf(
            '"%s" --host=%s --port=%s --user=%s %s %s < "%s"',
            $mysqlPath,
            $host,
            $port,
            $username,
            $password ? '--password=' . $password : '',
            $database,
            $file->getRealPath()
        );
        
        exec($cmd, $output, $returnVar);
        
        if ($returnVar !== 0) {
            return redirect()->back()->withErrors(['error' => 'Gagal memulihkan database. Pastikan format berkas SQL valid.']);
        }
        
        // Bersihkan cache aplikasi
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        
        return redirect()->back()->with('success', 'Database toko berhasil dipulihkan dari berkas SQL.');
    }
}
