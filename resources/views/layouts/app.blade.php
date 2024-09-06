<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css\dashboard.css') }}">
</head>
<body>
    <header class="header">
        <h1 class="welcome-message">@yield('header-title', 'Welcome!')</h1>
    </header>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
