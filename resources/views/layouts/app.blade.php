@php
    $colors = [
        'danger' => \Filament\Support\Color::Red,
        'gray' => \Filament\Support\Color::Gray,
        'primary' => \Filament\Support\Color::Violet,
        'success' => \Filament\Support\Color::Green,
        'warning' => \Filament\Support\Color::Amber,
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <style>[x-cloak] { display: none !important; }</style>
        @livewireStyles
        @filamentStyles
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=be-vietnam-pro:400,500,600,700" rel="stylesheet" />
        @vite('resources/css/app.css')

        <style>
            :root {
                --font-family: 'Be Vietnam Pro';

                @foreach ($colors as $key => $palette)
                    @foreach ($palette as $shade => $color)
                        --{{ $key }}-color-{{ $shade }}: {{ $color }};
                    @endforeach
                @endforeach
            }
        </style>
    </head>

    <body class="bg-gray-50 text-gray-900 antialiased">
        @yield('body')

        @livewire('notifications')

        @livewireScripts
        @filamentScripts
        @vite('resources/js/app.js')
        <script src="//unpkg.com/alpinejs" defer></script>
    </body>
</html>
