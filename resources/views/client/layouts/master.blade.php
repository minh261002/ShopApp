<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{ asset('client/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/boostrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/icons/tabler-icons-filled.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/icons/tabler-icons.css') }}">
    @stack('styles')
</head>

<body>

    @include('client.layouts.partials.header-top')
    @include('client.layouts.partials.header-main')
    @include('client.layouts.partials.navigation')
    <div class="w-100 app-bg">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <script src="{{ 'client/js/jquery.js' }}"></script>
    <script src="{{ asset('client/js/popper.js') }}"></script>
    <script src="{{ asset('client/js/bootstrap.js') }}"></script>

    @stack('scripts')
</body>

</html>
