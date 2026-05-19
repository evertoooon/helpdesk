<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'HelpDesk') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased text-slate-100 overflow-x-hidden">

        <div class="fixed inset-0 -z-10 bg-slate-950">
            <div id="blob-one"
                 class="absolute top-[-120px] left-[-120px] w-96 h-96 bg-blue-600/40 rounded-full blur-3xl"></div>

            <div id="blob-two"
                 class="absolute bottom-[-120px] right-[-120px] w-96 h-96 bg-purple-600/40 rounded-full blur-3xl"></div>

            <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-blue-950 to-purple-950"></div>

            <div class="absolute inset-0 opacity-20"
                 style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 32px 32px;">
            </div>
        </div>

        <div class="min-h-screen">

            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-white/10 bg-white/10 backdrop-blur-xl shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 page-content">
                {{ $slot }}
            </main>

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const pageContent = document.querySelector('.page-content');
                const blobOne = document.getElementById('blob-one');
                const blobTwo = document.getElementById('blob-two');

                if (pageContent) {
                    pageContent.style.opacity = '0';
                    pageContent.style.transform = 'translateY(12px)';
                    pageContent.style.transition = 'opacity 500ms ease, transform 500ms ease';

                    setTimeout(function () {
                        pageContent.style.opacity = '1';
                        pageContent.style.transform = 'translateY(0)';
                    }, 80);
                }

                document.addEventListener('mousemove', function (event) {
                    const x = event.clientX / window.innerWidth;
                    const y = event.clientY / window.innerHeight;

                    if (blobOne) {
                        blobOne.style.transform = `translate(${x * 40}px, ${y * 40}px)`;
                    }

                    if (blobTwo) {
                        blobTwo.style.transform = `translate(${x * -40}px, ${y * -40}px)`;
                    }
                });
            });
        </script>

    </body>
</html>