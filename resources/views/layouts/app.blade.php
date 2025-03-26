
<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'My Laravel App')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>

<body>

    @include('layouts.navbar')  <!-- Include Navbar -->

    <div class="container">
        @yield('content')  <!-- Dynamic content -->
    </div>

    @include('layouts.footer')  <!-- Include Footer -->

</body>
</html>
