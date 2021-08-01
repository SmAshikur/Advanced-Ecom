<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Stack Developers online Shopping cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Front style -->
    <link id="callCss" rel="stylesheet" href="{{asset('themes/css/front.min.css')}}" media="screen"/>
    <link href="{{asset('themes/css/base.css')}}" rel="stylesheet" media="screen"/>
    <!-- Front style responsive -->
    <link href="{{asset('themes/css/front-responsive.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('themes/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->
    <link href="{{asset('themes/js/google-code-prettify/prettify.css')}}" rel="stylesheet"/>
    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="{{asset('themes/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('themes/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('themes/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('themes/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('themes/images/ico/apple-touch-icon-57-precomposed.png')}}">
    <style type="text/css" id="enject"></style>
    <style>
        form.cmxform label.error,label.error{
            color: tomato;
            font-style: italic;
        }
    </style>
</head>
<body>
@include('layouts.userLayout.userHeader')
@include('layouts.userLayout.userBanner')
<!-- Header End====================================================================== -->
<div id="mainBody">
    <div class="container">
        <div class="row">
            <!-- Sidebar ================================================== -->
        @include('layouts.userLayout.userSidebar')
        <!-- Sidebar end=============================================== -->
            @yield('content')
        </div>
    </div>
</div>

<!-- Footer ================================================================== -->
@include('layouts.userLayout.userFooter')
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="{{asset('themes/js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('themes/js/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('themes/js/front.min.js')}}" type="text/javascript"></script>
<script src="{{asset('themes/js/google-code-prettify/prettify.js')}}"></script>

<script src="{{asset('themes/js/front.js')}}"></script>
<script src="{{asset('dist/js/user.js')}}"></script>
<script src="{{asset('themes/js/jquery.lightbox-0.5.js')}}"></script>


</body>
</html>
