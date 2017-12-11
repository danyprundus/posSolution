<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="keyword1, keyword2">
    <meta name="description" content=" ">
    <!-- SET: Title -->
    <title>Solutions POS</title>
    <!-- SET: Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- SET: Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.min.css') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/humanity/jquery-ui.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

</head>

<body>
<!-- wrapper starts -->
<div class="wrapper">
    <div class="main">

        <!-- header ends -->
        @yield('headerMenu')
        @yield('headerSearch')
        @yield('categories')
        @yield('operationOne')
        @yield('buyList')

        </section>
        @yield('operationTwo')
    </div>
    <!-- header starts -->

    <!--main-cont end-->
</div>
<!-- wrapper end-->

<!-- SET: SCRIPTS -->
@section('footerScripts')
<script type="text/javascript" src="{{ asset('assets/js/jquery-1.11.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.js"></script>
@show
<script type="text/javascript"></script>




</body>
</html>