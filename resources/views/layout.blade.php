<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>One Time Secrets</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main role="main" class="container">
        <div class="row mt-5">
            <div class="col-lg-8 offset-lg-2">
                <h1><i class="fas fa-user-secret fa-fw"></i> One Time Secrets</h1>
                @yield('content')
            </div>
        </div>
    </main>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
