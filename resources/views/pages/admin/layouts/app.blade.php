<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/Backend/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ url('/Backend/assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ url('/Backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('/Backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('/Backend/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ url('/Frontend/Asset/Images/Logo-Gokarang.png') }}" type="image/x-icon">
    @stack('style')
</head>

<body>
    <div id="app">

        {{-- insert navigation blade below --}}
        @include('pages.admin.layouts.navigation')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{-- <div class="page-heading">
                change page heading below
                <h3>Profile Statistics</h3>
            </div> --}}
            <div class="page-content">
                {{-- insert blade below --}}
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        2022 Copyright Gokarang
                    </div>
                    <div class="float-end">
                        All rights reserved
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ url('/Backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('/Backend/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('/Backend/assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ url('/Backend/assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ url('/Backend/assets/js/mazer.js') }}"></script>

    @stack('script')
</body>

</html>
