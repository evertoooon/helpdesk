<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HelpDesk') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#081225] text-white antialiased">

    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,#123b7a_0%,transparent_32%),radial-gradient(circle_at_bottom_right,#4b087a_0%,transparent_35%),linear-gradient(135deg,#071122,#111b46,#2b0b4f)]">

        <div class="min-h-screen bg-[radial-gradient(circle,rgba(255,255,255,.14)_1px,transparent_1px)] [background-size:34px_34px]">

            {{ $slot }}

        </div>

    </div>

</body>

</html>