<!doctype html>
<html lang="en">

<head>
    <title>fimliduniya</title>
    <!-- Required meta tags -->
    @stack('title')

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="">


    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <script src="{{ asset('app.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{-- jquery cdn --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <header>
        <nav>
            @if (auth()->user())
                <a href="{{ url('/dashboard') }}"><img src="{{ asset('favicon.ico') }}" alt="Logo" id="icon"></a>
            @else
                <a href="{{ url('/') }}"><img src="{{ asset('favicon.ico') }}" alt="Logo" id=icon></a>
            @endif

            <ul>
                <li><a href="{{ url('aboutus ') }}">About Us</a></li>
                @if (auth()->user())
                    <li><a href="{{ route('contacts.index') }}">Contacts</a></li>
                    <li><a href="#" onclick="logout()">Logout</a></li>
                </li>
                @else
                    <li><a href="{{ url('contact') }}">Contact Us</a></li>
                    <li><a href="{{ url('login') }}">Login</a></li>
                @endif

            </ul>
        </nav>
        <p class="text-primary">Current Time: {{ now()->format('d-M-y') }}</p>
    </header>
    <main>
        @yield('content')
    </main>
