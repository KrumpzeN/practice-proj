<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional stylesheets -->
    @stack('styles')
</head>
<body>
    <header>
        <!-- Navigation bar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">My App</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bikes.index') }}">Bikes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.create') }}">Order a bike</a>
                        </li>
                        <!-- Add more navigation links as needed -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main role="main">
        <div class="container mt-4">
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <span class="text-muted"></span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Additional scripts -->
    @stack('scripts')
</body>
</html>