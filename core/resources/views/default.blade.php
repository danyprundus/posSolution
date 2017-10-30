<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{get_company_name()}} | {{trans('application.login')}}</title>
    <!-- Loading the bootstrap css  -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/sweet-alert/themes/google/google.css') }}" rel="stylesheet" type="text/css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        {{get_company_name()}}
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        @yield('content')
    </div>
    <section class="panel-footer">
        <a href="{{ url('password/email') }}">Lost your password?</a>
    </section>
</div>
<!-- jQuery 2.1.3 -->
<script src="{{ asset('assets/js/jquery-2.1.3.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- validator.js javascript-->
<script src="{{ asset('assets/js/validator.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>

<script>
    $(function(){
        $('form').validator();
    });
</script>
@if (Session::has('flash_notification.level'))
    <?php $message_type = Session::get('flash_notification.level'); ?>
    @if($message_type == 'success')
        <script>
            swal({title: "Success",text: "{{ Session::get('flash_notification.message') }}",type: "success"});
        </script>
    @elseif($message_type == 'danger')
        <script>
            swal({title: "Error",text: "{{ Session::get('flash_notification.message') }}",type: "error"});
        </script>
    @endif
@endif
</body>
</html>