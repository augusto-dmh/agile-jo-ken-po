<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex w-svw h-svh align-center bg-primary">
        <div class="w-[42rem] flex items-center flex-col gap-12 p-5 m-auto font-sans antialiased menu-container">
            <div class="menu-title-wrapper">
                <a href="{{route('home')}}">
                    <img src="{{asset('storage/logo.png')}}" class="h-28 w-52">
                </a>
            </div>
            <div class="flex justify-between gap-20 menu-modes">
                <div class="rounded-full hover:shadow-outer-bright w-44 h-44 image-wrapper float">
                    <a href="{{route('play-simple-mode')}}">
                        <img src="{{asset('storage/modes/simple.png')}}" class="w-full h-full">
                    </a>
                </div>

                <div class="rounded-full hover:shadow-outer-bright w-44 h-44 image-wrapper float">
                    <a href="{{route('play-x-luck-mode')}}">
                        <img src="{{asset('storage/modes/x2.png')}}" class="w-full h-full">
                    </a>
                </div>
            </div>
            <div class="flex flex-col gap-4 text-center menu-buttons">
                <a href="{{route('login')}}" class="px-24 py-2 bg-white font-pixelify hover:bg-slate-200 hover:shadow-outer-bright">Login</a>
                <a href="{{route('register')}}" class="px-24 py-2 bg-white font-pixelify hover:bg-slate-200 hover:shadow-outer-bright">Cadastro</a>
            </div>
        </div>
    </body>
</html>
