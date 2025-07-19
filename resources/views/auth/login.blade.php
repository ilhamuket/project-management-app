<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - PSU Kabupaten Berau</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://preline.co/assets/css/main.css?v=3.1.0">
    
    <!-- Theme Script -->
    <script>
        const html = document.querySelector('html');
        const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') === 'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
        const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
        else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
        else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
        else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');
    </script>
</head>
<body class="h-full bg-gray-50 dark:bg-neutral-900">
    <div class="flex flex-col justify-center items-center min-h-screen py-4 px-4">
        <main id="content" class="w-full max-w-sm">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
                <div class="p-4 sm:p-5">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/img/logo-berau.png') }}" class="w-20 h-auto mx-auto mb-2" alt="Logo PSU Kabupaten Berau">
                        <h1 class="text-lg font-bold text-gray-800 dark:text-white">Masuk</h1>
                        <p class="mt-1 text-xs text-gray-600 dark:text-neutral-400">
                            Belum punya akun?
                            <a class="text-blue-600 hover:underline font-medium dark:text-blue-500" href="{{ route('register') }}">
                                Daftar di sini
                            </a>
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-3 p-2 text-xs text-green-800 rounded bg-green-50 dark:bg-green-800/10 dark:text-green-400" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="space-y-3">
                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-xs font-medium mb-1 dark:text-white">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="py-2 px-3 block w-full border-gray-200 rounded text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500" required autofocus autocomplete="username" placeholder="nama@example.com">
                                @error('email')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-xs font-medium mb-1 dark:text-white">Password</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" class="py-2 px-3 block w-full border-gray-200 rounded text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500" required autocomplete="current-password" placeholder="Password">
                                    <button type="button" data-hs-toggle-password='{"target": "#password"}' class="absolute inset-y-0 end-0 flex items-center z-20 px-2 cursor-pointer text-gray-400 rounded-e focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                                        <svg class="shrink-0 size-3" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                            <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                            <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                            <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                                            <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                            <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox" class="shrink-0 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700">
                                <label for="remember_me" class="text-xs text-gray-600 ms-2 dark:text-white">Ingat saya</label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="w-full py-2 px-3 text-sm font-medium rounded border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                                Masuk
                            </button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-3 text-center">
                <p class="text-xs text-gray-500 dark:text-neutral-400">
                    © {{ date('Y') }} PSU Kabupaten Berau
                </p>
            </div>
        </main>
    </div>

    <!-- Theme Toggle -->
    <div class="fixed top-3 right-3 z-50">
        <button type="button" class="hs-dark-mode-active:hidden hs-dark-mode p-2 text-gray-600 hover:text-blue-600 dark:text-neutral-400" data-hs-theme-click-value="dark">
            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
            </svg>
        </button>
        <button type="button" class="hs-dark-mode-active:inline-flex hidden hs-dark-mode p-2 text-gray-600 hover:text-blue-600 dark:text-neutral-400" data-hs-theme-click-value="light">
            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="4"></circle>
                <path d="M12 2v2"></path>
                <path d="M12 20v2"></path>
                <path d="m4.93 4.93 1.41 1.41"></path>
                <path d="m17.66 17.66 1.41 1.41"></path>
                <path d="M2 12h2"></path>
                <path d="M20 12h2"></path>
                <path d="m6.34 17.66-1.41-1.41"></path>
                <path d="m19.07 4.93-1.41-1.41"></path>
            </svg>
        </button>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/preline/dist/index.js"></script>
</body>
</html>