<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- Vite: Pastikan memanggil CSS dan JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Inter --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    
    <title>{{ $title ?? 'Dashboard' }}</title>
</head>
<body class="h-full">

    <div class="min-h-full">
        {{-- NAVBAR DASHBOARD (Sederhana) --}}
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-white font-bold text-xl">My Dashboard</span>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                {{-- Link Navigasi Dashboard --}}
                                <a href="/dashboard" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
                                <a href="{{ route('dashboard.posts.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">My Posts</a>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Tombol Logout --}}
                    <div class="block">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-white-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        {{-- HEADER --}}
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $title ?? 'Dashboard' }}</h1>
            </div>
        </header>

        {{-- KONTEN UTAMA --}}
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    {{-- Script Flowbite (PENTING UNTUK INTERAKSI) --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>
</html>