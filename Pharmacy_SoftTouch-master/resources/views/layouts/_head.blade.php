<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PMS') }} @yield('title')</title>

    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">

    <!-- JS -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/plugins/toastr.min.js')}} " type="text/javascript"></script>
    <script src="{{asset('js/plugins/print.js')}}" type="text/javascript"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('js/plugins/Trumbowyg/dist/ui/trumbowyg.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Condensed:wght@400;500;600&family=Viga&display=swap" rel="stylesheet">
    @if(get_setting()->color === 'white' )
        <link href="{{ asset('css/white_main.css') }}" rel="stylesheet">
    @elseif(get_setting()->color === 'black')
        <link href="{{ asset('css/black_main.css') }}" rel="stylesheet">
    @endif
     <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

     <link rel="stylesheet" href="{{asset('/js/plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}">
     <link rel="stylesheet" href="{{asset('/js/treeview/jquery.treemenu.css')}}">
    <style>
        .custom_typography,.custom_typography td,.custom_typography td a{
            text-align: center;
            font-weight: bolder;
            font-size: 16px;
            font-family: Cabin Condensed,sans-serif;
        }
        .custom_h_typography h3{
            text-align: center;
            font-weight: bolder;

            font-family: Cabin Condensed,sans-serif;
        }
    </style>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
