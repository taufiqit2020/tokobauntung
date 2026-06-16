<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BAUNTUNGPOS</title>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#4f46e5">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', 'Instrument Sans', sans-serif;
        }
        .mesh-gradient {
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 10% 10%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 90% 10%, rgba(168, 85, 247, 0.15) 0px, transparent 50%),
                radial-gradient(at 50% 90%, rgba(236, 72, 153, 0.1) 0px, transparent 50%);
        }
    </style>
</head>
<body class="mesh-gradient min-h-[100dvh] flex flex-col justify-center items-center p-4 sm:p-8 text-slate-100 relative overflow-y-auto">

    <!-- Decorative background elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-purple-600/30 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md z-10">
        <!-- Logo / Store Header -->
        <div class="text-center mb-6 mt-8 sm:mt-0 sm:mb-8">
            <div class="inline-flex items-center justify-center p-3 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-2xl shadow-lg shadow-indigo-500/20 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold tracking-tight bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                BAUNTUNGPOS
            </h1>
            <p class="text-slate-400 text-sm mt-1 uppercase tracking-widest font-semibold">Toko Plastik & Sembako</p>
        </div>

        <!-- Glass Card Login Form -->
        <div class="backdrop-blur-md bg-slate-900/60 border border-slate-700/50 rounded-2xl shadow-2xl p-8">
            <h2 class="text-xl font-semibold text-white mb-6">Masuk ke Sistem</h2>

            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-lg p-3 text-sm mb-5">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-lg p-3 text-sm mb-5">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf
                <!-- Username Input -->
                <div>
                    <label for="username" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Username atau Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" required
                               class="block w-full pl-10 pr-3 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-sm"
                               placeholder="Contoh: jumiati atau keuangan">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required
                               class="block w-full pl-10 pr-14 py-3 bg-slate-800/50 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-sm"
                               placeholder="********">
                        <button type="button" onclick="togglePassword()" title="Tampilkan Sandi" class="absolute inset-y-0 right-0 px-4 flex items-center justify-center text-indigo-400 hover:text-indigo-300 focus:outline-none cursor-pointer bg-slate-800/80 rounded-r-xl border-l border-slate-700">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Reset info -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-slate-400 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-700 bg-slate-800 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-900 mr-2">
                        Ingat Saya
                    </label>
                    <span class="text-xs text-indigo-400 font-semibold cursor-help" title="Silakan hubungi IT Admin untuk melakukan reset password Anda.">Lupa Password?</span>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all text-sm active:scale-95 cursor-pointer">
                    Masuk Sekarang
                </button>
            </form>
        </div>

        <!-- Footnote / Address -->
        <p class="text-center text-slate-500 text-xs mt-6">
            Jl. Panglima Batur, Komet, Banjarbaru Utara
        </p>
    </div>

    <!-- PWA Service Worker Registration & Scripts -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Change to eye-slash icon
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />';
            } else {
                passwordInput.type = 'password';
                // Change to normal eye icon
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />';
            }
        }

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(reg => console.log('Service Worker registered.'))
                    .catch(err => console.log('Service Worker registration failed: ', err));
            });
        }
    </script>
</body>
</html>
