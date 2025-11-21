<html>
    <head>
        <title>{{ $title ?? 'Example Website'}}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <nav>
            <h3>Welcome to my Website</h3>
            <hr>
        </nav>
        {{ $slot }}
        <footer>
            <hr/>
            <p>&copy; 2024 Example.com</p>
        </footer>
    </body>
</html>