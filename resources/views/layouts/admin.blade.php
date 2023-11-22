<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

    <!-- jsvectormap css -->
    <link href="{{ asset('admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('admin/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('customcss')
    @livewireStyles()
</head>

<body>


<div id="wrapper">

    <!-- Header -->
    @include('admin.blocks.header')

    <!-- sidebar -->
    @include('admin.blocks.sidebar')

    <!-- Main Contents -->
    @yield('content')

</div>

{{--@include('clients.blocks.right')--}}



{{--admin javascript--}}
<script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('admin/assets/images/svg/crypto-icons/waves.svg')}}"></script>
<script src="{{asset('admin/assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('admin/assets/js/plugins.js')}}"></script>

<!-- apexcharts -->
<script src="{{asset('admin/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- Vector map-->
<script src="{{asset('admin/assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/jsvectormap/maps/world-merc.js')}}"></script>

<!--Swiper slider js-->
<script src="{{asset('admin/assets/libs/swiper/swiper-bundle.min.js')}}"></script>

<!-- Dashboard init -->
<script src="{{asset('admin/assets/js/pages/dashboard-ecommerce.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('admin/assets/js/app.js')}}"></script>

@yield('js')
@livewireScripts()
</body>


</html>
