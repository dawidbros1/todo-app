<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('css')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                @if (auth()->check())
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('category.index') }}">Moje kategorie</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul id="username-dropdown" class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another act ion</a></li>
                                <li><a class="dropdown-item" href="#">Something else here 22222 2</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"> Wyloguj </a></li>
                            </ul>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Rejestracja</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logowanie</a></li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
    <main class="container-fluid">
        @if (session('success') || session('error'))
            <div class="my-2" id="message">
                @if (session('success'))
                    <div class="alert alert-success">
                        <div id="close">X</div>
                        {{ session('success') }}
                    </div>
                @else
                    <div class="alert alert-danger">
                        <div id="close">X</div>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        @endif

        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>
