<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- AdminLTE CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
<!-- Bootstrap CSS (if not already included) -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body class="bg-light">
    <div class="wrapper">
        <!-- Navbar -->
        @include('app.header')

            <!-- Sidebar (for large screens) -->
            @include('app.sidebar')

            <!-- Main Content -->
            <div class="wrapper">
                @yield('main')
                <footer class=" text-white text-center ">
                    <div class="text-center bg-light p-3">
                        © 2024 Created by <a href="#" class="text-dark fw-bold">Zaid</a>
                    </div>
                </footer>

            </div>

    </div>

    <!-- Footer -->


    <!-- Scripts -->
    <!-- Bootstrap JS Bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{  asset('js/script.js') }}"></script>
    <!-- Custom JS -->
    @yield('script')

</body>

</html>
