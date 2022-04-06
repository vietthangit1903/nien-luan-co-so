<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niên luận cơ sở</title>
    <link rel="shortcut icon" href="./assets/img/logo1.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Raleway:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <div id="preloader">
        <div id="loader"></div>
    </div>
    <!-- Header -->
    @include('layout.header')
    <!-- End Header -->

    <div class="container-xl content">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('layout.footer')
    <!-- Footer -->

    <script src="./assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>

        var loader = document.querySelector('#preloader');
        window.addEventListener('load', function () {
            loader.style.display = "none";
        })
    </script>
</body>

</html>