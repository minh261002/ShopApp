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
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/css/toast@1.0.1/fuiToast.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

    @stack('styles')

    <script>
        const BASEURL = "{{ rtrim(env('APP_URL'), '/') }}/";
    </script>
</head>

<body class="bg-white">
    <div id="fui-toast"></div>

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

    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/js/toast@1.0.1/fuiToast.min.js"></script>

    @if (session('success'))
        <script>
            FuiToast.success('{{ session('success') }}');
        </script>
    @endif

    @if (session('error'))
        <script>
            FuiToast.error('{{ session('error') }}');
        </script>
    @endif

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                FuiToast.error('{{ $error }}');
            @endforeach
        </script>
    @endif

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&language=vi&callback=initMaps">
    </script>
    <script>
        function initMaps() {
            try {
                if (typeof initMap === 'function') {
                    console.log("Calling initMap");
                    initMap();
                } else {
                    console.error("initMap is not defined");
                }

            } catch (error) {
                console.error("Error in initMaps:", error);
                window.location.reload();
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
