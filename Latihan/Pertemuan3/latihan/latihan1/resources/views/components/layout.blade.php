<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Script Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title ?? 'Website Saya' }}</title>
</head>
<body class="h-full flex flex-col">

    {{-- NAVBAR --}}
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">MyWebsite</div>
            <div class="space-x-4">
                {{-- Update link navigasi --}}
                <a href="/" class="hover:text-gray-300">Home</a>
                <a href="/about" class="hover:text-gray-300">About</a>
                <a href="/blog" class="hover:text-gray-300">Blog</a>
                <a href="/contact" class="hover:text-gray-300">Contact</a>
                <a href="/categories" class="hover:text-gray-300">Categories</a>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="flex-grow container mx-auto p-6">
        {{ $slot }}
    </main>

    {{-- FOOTER BARU --}}
    <footer class="bg-gray-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 Website Latihan Laravel. Dibuat dengan sepenuh hati.</p>
    </footer>

</body>
</html>