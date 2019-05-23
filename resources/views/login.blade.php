<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dreamguys.co.in/preclinic/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 May 2019 06:19:48 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('public')}}/assets/img/favicon.ico">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" type="text/css" href="{{url('public')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('public')}}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('public')}}/assets/css/style.css">
    <!--[if lt IE 9]>
    <script src="{{url('public')}}/assets/js/html5shiv.min.js"></script>
    <script src="{{url('public')}}/assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form method="POST" action="{{ route('login') }}" class="form-signin">
                    @csrf
                    <div class="account-logo">
                        <a href="index.html"><img src="{{url('public')}}/assets/img/logo-dark.png" alt=""></a>
                    </div>

                    <div class="form-group">
                        <label>Email</label>


                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                    </div>


                    <div class="form-group">
                        <label>Password</label>


                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                    </div>
                    <div class="form-group">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                    </div>
                    <div class="form-group text-right">
                        <a href="forgot-password.html">Forgot your password?</a>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary account-btn">Login</button>
                    </div>
                    <div class="text-center register-link">
                        Don’t have an account? <a href="register.html">Register Now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{url('public')}}/assets/js/jquery-3.2.1.min.js"></script>
<script src="{{url('public')}}/assets/js/popper.min.js"></script>
<script src="{{url('public')}}/assets/js/bootstrap.min.js"></script>
<script src="{{url('public')}}/assets/js/app.js"></script>
</body>


<!-- Mirrored from dreamguys.co.in/preclinic/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 May 2019 06:19:48 GMT -->
</html>