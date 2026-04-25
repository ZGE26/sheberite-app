<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-900 bg-gradient-to-b from-emerald-50 via-slate-50 to-amber-50">

    <div class="min-h-screen" x-data="{ sidebarOpen: false }" x-init="sidebarOpen = window.innerWidth >= 1024"
        @resize.window="sidebarOpen = window.innerWidth >= 1024 ? true : sidebarOpen">

        @if (!isset($fullWidth) || !$fullWidth)
            <x-sidebar />
        @endif

        <div class="transition-all duration-300 {{ !isset($fullWidth) || !$fullWidth ? 'lg:pl-72' : '' }}">

            <div class="mx-auto w-full max-w-full px-4 pb-8 pt-20 sm:px-6 lg:px-8 {{ !isset($fullWidth) || !$fullWidth ? 'lg:pt-8' : 'pt-8' }}">

                @isset($header)
                    <header class="mb-6 flex items-center gap-4">
                        @if (isset($backUrl))
                            <a href="{{ $backUrl }}"
                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white text-emerald-700 shadow-sm ring-1 ring-emerald-100 transition hover:bg-emerald-50 hover:text-emerald-800">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
                                </svg>
                            </a>
                        @endif

                        <div class="flex-1">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <div
                    class="rounded-3xl border border-emerald-100/70 bg-emerald-50/70 p-5 shadow-sm sm:p-8 backdrop-blur-sm w-full">
                    <main>
                        {{ $slot }}
                    </main>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
