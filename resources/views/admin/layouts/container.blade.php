<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Web Admin | Pemerintah Kabupaten Bojonegoro</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="shortcut icon" href="{{ URL::to("/images/favicon.png") }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.header')
<!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="@yield('body-class') fixed">
<div class="wrapper">
    <header class="main-header">
        <a href="{{ URL::to('/home') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b><span class="glyphicon glyphicon-home"></span></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>C</b>MS</span>
        </a>
    @include('admin.layouts.navbarHeader')
    </header>
    @include('admin.layouts.sideMenu')
    <div class="content-wrapper">
        <section class="content-header">
            <h1> @yield('title')<small>@yield('title_description')</small></h1>
        </section>
        <section class="content">
            @yield('content')
        </section>
    </div>
    <footer class="main-footer">
        <strong>{{ config('website.website_copyright') }} <a href="{{ URL::to('/') }}">{{ config('website.website_title') }}</a></strong> All rights reserved.
    </footer>
    <div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->
    @include('admin.layouts.footer')
</body>
</html>
