<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Application</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <!-- Your header content here -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Your footer content here -->
    </footer>
</body>
</html>
