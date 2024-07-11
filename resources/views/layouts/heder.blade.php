<!doctype html>
<html lang="en">

<head>
    <title>fimliduniya</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <nav>
            <a href="{{ url('/') }}"><img src="favicon.ico" alt="Logo" id=icon></a>
            <ul>
                <li><a href="{{ url('aboutus ') }}">About Us</a></li>
                <li><a href="{{ url('contact ') }}">Contact Us</a></li>
                <li><a href="{{ url('login ') }}" >Login</a></li>

            </ul>
        </nav>
<p class="text-primary">Current Time:{{ now()->format('d-M-y') }}</p>
    </header>
    <main>
        @yield('content')
    </main>
