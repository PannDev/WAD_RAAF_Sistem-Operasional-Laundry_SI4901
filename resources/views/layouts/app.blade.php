<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Operasional Laundry') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Montserrat & Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">

    <style>
        /* 1. Pengaturan Font Global */
        body {
            font-family: "Poppins", sans-serif;
            background-color: #ffffff;
            color: #111111;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .navbar-brand,
        .header-banner h1,
        .header-banner h2,
        .header-banner h3 {
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        /* 2. Skema Warna Hitam Putih */
        .navbar {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e5e5e5;
            box-shadow: none !important;
        }

        .navbar-brand,
        .nav-link {
            color: #111111 !important;
        }

        /* Banner Atas (Override warna biru) */
        .bg-primary,
        .bg-info,
        .header-banner {
            background-color: #111111 !important;
            color: #ffffff !important;
            border: 1px solid #111111;
        }

        /* Judul & Teks Aksen (Override biru/hijau) */
        .text-primary,
        .text-success,
        .text-info {
            color: #111111 !important;
        }

        /* Card Container */
        .card {
            background-color: #ffffff;
            border: 1px solid #dcdcdc;
            border-radius: 10px;
            box-shadow: none !important;
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e5e5;
        }

        /* Input & Select Form */
        .form-label,
        label {
            font-weight: 600;
            color: #111111;
        }

        .form-control,
        .form-select {
            font-family: "Poppins", sans-serif;
            background-color: #ffffff;
            color: #111111;
            border: 1px solid #cccccc;
            border-radius: 6px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #111111;
            box-shadow: 0 0 0 0.2rem rgba(17, 17, 17, 0.15);
        }

        /* Tombol Utama & Simpan (Hitam Solid) */
        .btn-success,
        .btn-primary,
        .btn-dark {
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            background-color: #111111 !important;
            border-color: #111111 !important;
            color: #ffffff !important;
            border-radius: 6px;
            padding: 8px 18px;
            transition: background-color 0.2s ease;
        }

        .btn-success:hover,
        .btn-primary:hover,
        .btn-dark:hover {
            background-color: #333333 !important;
            border-color: #333333 !important;
        }

        /* Tombol Sekunder / Edit / Hapus (Monokrom) */
        .btn-warning,
        .btn-outline-dark {
            font-family: "Poppins", sans-serif;
            background-color: #ffffff !important;
            border: 1px solid #111111 !important;
            color: #111111 !important;
            border-radius: 6px;
        }

        .btn-warning:hover,
        .btn-outline-dark:hover {
            background-color: #f2f2f2 !important;
        }

        .btn-danger {
            font-family: "Poppins", sans-serif;
            background-color: #2b2b2b !important;
            border-color: #2b2b2b !important;
            color: #ffffff !important;
            border-radius: 6px;
        }

        /* Tabel Inventaris Mesin */
        .table thead th {
            font-family: "Montserrat", sans-serif;
            font-weight: 600;
            background-color: #f5f5f5;
            color: #111111;
            border-bottom: 2px solid #111111;
        }

        .table tbody td {
            color: #222222;
            border-color: #e5e5e5;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Sistem Operasional Laundry') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle (Wajib agar dropdown Logout berfungsi) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>