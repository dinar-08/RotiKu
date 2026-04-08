<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Login - RotiKu' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-section {
            background-image: url("{{ asset('images/bgrnd roti.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(3px);
        }
        .hero-content {
            position: relative;
            z-index: 10;
        }
        .form-container {
            box-shadow: -8px 0 32px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased h-screen">
    <div class="flex h-full">
        <!-- Bagian Kiri (Hero) - 60% width -->
        <div class="hidden md:flex w-full md:w-[60%] hero-section">
            <div class="hero-overlay"></div>
            <div class="hero-content w-full flex flex-col justify-center items-center text-center p-12 text-white">
                @if(request()->routeIs('register'))
                    <h1 class="text-5xl font-bold mb-6 leading-tight">Bergabunglah<br>dengan RotiKu</h1>
                    <p class="text-xl mb-8 max-w-md">Daftar sekarang untuk pengalaman belanja roti premium</p>
                @else
                    <h1 class="text-5xl font-bold mb-6 leading-tight">Selamat Datang<br>di RotiKu</h1>
                    <p class="text-xl mb-8 max-w-md">Temukan kelezatan roti berkualitas premium dengan resep turun temurun</p>
                @endif
                
                <div class="w-full max-w-xs border-t border-white/20 pt-6">
                    @if(request()->routeIs('register'))
                        <p class="mb-4">Sudah memiliki akun?</p>
                        <a href="{{ route('login') }}" class="inline-block w-full py-3 border-2 border-white rounded-lg hover:bg-white hover:text-brown-800 transition duration-300 text-lg font-medium">
                            Masuk
                        </a>
                    @else
                        <p class="mb-4">Belum punya akun?</p>
                        <a href="{{ route('register') }}" class="inline-block w-full py-3 border-2 border-white rounded-lg hover:bg-white hover:text-brown-800 transition duration-300 text-lg font-medium">
                            Daftar
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bagian Kanan (Form) - 40% width -->
        <div class="w-full md:w-[40%] flex items-center justify-center bg-gray-50 p-6">
            <div class="form-container w-full max-w-md bg-white rounded-none md:rounded-l-2xl p-8 md:p-12 h-full md:h-auto flex flex-col justify-center">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>