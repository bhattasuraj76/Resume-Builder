@section('header')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="images/png" href="{{asset('public/img/favicon.png')}}" />

    <!-- styles -->
    <link rel="stylesheet" href="{{asset('public/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendor/jquery-smart-wizard/css/smart_wizard_all.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/front/css/helper_style.css')}}">
    <link rel="stylesheet" href="{{asset('public/front/css/main.css')}}">

    <!-- import styles from inner pages -->
    @yield('after-styles')

    <title> @yield('title', config('website_default.site_name'))</title>
</head>

<body>
    @endsection