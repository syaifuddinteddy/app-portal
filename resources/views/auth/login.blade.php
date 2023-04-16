<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Web Admin |  Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="{{ URL::to('/engine/bootstrap/css/bootstrap.min.css') }}" type="text/css"/>
    <link href="{{ URL::to('/engine/adminLTE/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href=""><strong>Web</strong> Administration</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <p class="login-box-msg">Panel Administrasi<br />Web Portal Kabupaten Bojonegeoro</p>
            <form action="{{ URL::to('login') }}" method="post">
                {{csrf_field()}}
                <div class="form-group has-feedback">
                    <input type="username" name="username" class="form-control" placeholder="Username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="{{ URL::to('/engine/adminLTE/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ URL::to('/engine/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('/engine/adminLTE/dist/js/adminlte.min.js') }}"></script>
<script src="{{ URL::to('/engine/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
