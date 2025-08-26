<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Hotel Hebat' }}</title>

    <!-- Bootstrap & jQuery -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fc;
        }

        .navbar {
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
            color: #fff !important;
        }

        .nav-link {
            color: #fff !important;
            margin-right: 12px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #ffe082 !important;
        }

        /* Buttons for login/register */
        .nav-btn {
            font-weight: 600;
            border-radius: 25px;
            padding: 6px 18px !important;
            transition: all 0.3s ease;
            margin-left: 10px;
        }

        .nav-btn-login {
            background: transparent;
            border: 2px solid #fff;
            color: #fff !important;
        }
        .nav-btn-login:hover {
            background: #fff;
            color: #0d6efd !important;
        }

        .nav-btn-register {
            background: #ffc107;
            border: 2px solid #ffc107;
            color: #212529 !important;
        }
        .nav-btn-register:hover {
            background: #ffca2c;
            border-color: #ffca2c;
            color: #000 !important;
        }

        .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,.1);
        }

        main {
            padding: 40px 20px;
        }

        footer {
            background: #0d6efd;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }

        /* Alert fade effect */
        .alert {
            border-radius: 12px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('landing') }}">
                    <i class="fas fa-hotel"></i> Mermoura Hotel
                </a>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link nav-btn nav-btn-login" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt"></i> Login
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link nav-btn nav-btn-register" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus"></i> Register
                                    </a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item"><a class="nav-link" href="{{ route('roomtype.index') }}">Room Types</a></li>
                            @elseif(Auth::user()->role == 'resepsionis')
                                <li class="nav-item"><a class="nav-link" href="{{ route('receptionis.logs') }}">Logs</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('receptionis.checkin') }}">Check In</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('receptionis.checkin.pdata') }}">Check In with Personal Data</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('receptionis.reservations') }}">Reservations</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ route('customer.room.types') }}">Room Types</a></li>
                                <li class="nav-item"><a class="nav-link" href="#fasilitas">Facilities</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tentang">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="#kontak">Contact</a></li>
                            @endif

                            <!-- User Dropdown -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <main>
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer>
            <p>&copy; 2025 Hotel Hebat. All Rights Reserved.</p>
        </footer>
    </div>

    @yield('script')

    <script>
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 3000);
    </script>
</body>
</html>
