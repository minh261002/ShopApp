<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('uploads/images/favicon.ico') }}" type="image/x-icon">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{ asset('client/css/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('client/css/boostrap.css') }}"> --}}
    <link href="{{ asset('admin/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/demo.min.css?1692870487') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/icons/tabler-icons-filled.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/icons/tabler-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/owl.theme.default.min.css') }}">

    @stack('styles')
</head>

<body class="bg-white">

    @include('client.layouts.partials.header-top')
    @include('client.layouts.partials.header-main')
    @include('client.layouts.partials.navigation')
    <div class="w-100 app-bg">
        <div class="container">
            @yield('content')
        </div>
    </div>

    @include('client.layouts.partials.footer')

    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('admin/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('admin/js/demo.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('client/js/owl.carousel.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
