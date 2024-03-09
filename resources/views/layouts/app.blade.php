<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}" />
</head>

<body class="h-screen">

    <div class="w-full h-full">
        <dh-component>
            <div id="app">

                @auth

                <navbar-component :user="{{Auth::id()}}"></navbar-component>

                <form 
                    id="logout-form" 
                    action="{{ route('logout') }}" 
                    method="POST" 
                    class="d-none"
                >
                    @csrf
                </form>

                @endauth

                @yield('content')
            </div>
        </dh-component>
    </div>

</body>

</html>