<?php
/**
 * Created by aidiCMS.
 * Project Name : anggaran
 * Date Created : 2017-10-27
 * Time Created : 09:10
 */
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SISCA | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::to($domain."/favicon/apple-icon-57x57.png") }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::to($domain."/favicon/apple-icon-60x60.png") }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::to($domain."/favicon/apple-icon-72x72.png") }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::to($domain."/favicon/apple-icon-76x76.png") }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::to($domain."/favicon/apple-icon-114x114.png") }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::to($domain."/favicon/apple-icon-120x120.png") }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::to($domain."/favicon/apple-icon-144x144.png") }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::to($domain."/favicon/apple-icon-152x152.png") }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::to($domain."/favicon/apple-icon-180x180.png") }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::to($domain."/favicon/android-icon-192x192.png") }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::to($domain."/favicon/favicon-32x32.png") }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::to($domain."/favicon/favicon-96x96.png") }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to($domain."/favicon/favicon-16x16.png") }}">
    <meta name="msapplication-TileImage" content="{{ URL::to($domain."/favicon/ms-icon-144x144.png") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.header')
</head>

<body class="@yield('body-class') fixed">
<div class="wrapper">
    <header class="main-header">
        <a href="{{ URL::route('dashboard') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b><span class="glyphicon glyphicon-home"></span></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SISCA</b></span>
        </a>
        @include('admin.layouts.navbarHeader')
    </header>
    @include('admin.layouts.sideMenu')
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>
    <footer class="main-footer">
        <strong>{{ config('website.website_copyright') }} <a href="{{ URL::to($domain) }}">{{ config('website.website_title') }}</a></strong> All rights reserved.
    </footer>
    <div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->
@include('admin.layouts.footer')
</body>
</html>
