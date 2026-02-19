<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <link rel="icon" href="data:,">

  
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">

    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 relative">

       
        <div class="mb-6">
            <a href="/">
                <img src="{{ asset('img/logo_smk.png') }}" 
                     alt="Logo SMKN 1 Maja" 
                     class="w-20 h-20 object-contain">
            </a>
        </div>

       
        <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-md sm:rounded-lg">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
