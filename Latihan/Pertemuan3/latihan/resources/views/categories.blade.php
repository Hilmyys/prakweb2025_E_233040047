<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Categories</title>
</head>
<body>
    <h1>All Categories</h1>

    <ul>
        @foreach ($categories as $category)
            <li>
                <h2>{{ $category->name }}</h2>
                <a href="/categories/{{ $category->slug }}">Lihat Detail</a>
            </li>
        @endforeach
    </ul>
</body>
</html>