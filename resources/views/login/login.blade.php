<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | business development</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('assets/css/bootstrap-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="loading authentication-bg authentication-bg-pattern">
    <div class="account-pages">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-lg-2 offset-md-2 col-md-8 col-lg-8 col-xl-5 text-center">
                    <img src="{{ asset('assets/images/logo.png') }}" width="120" class="m-auto loginlogo" />
                    <div class="card z-3">
                        <div class="contact-form">
                            <h3 class="text-center">Login to your account</h3>
                            <p class="text-center">
                                Enter your email id as 'Username' to login to your Business Development
                                Account.
                            </p>
                            <!-- start-form -->

                            <form class="contact_form" action="{{ route('login') }}" method="post" name="contact_form" autocomplete="off">
                                @csrf
                                <ul>
                                    <li>
                                        <input type="text" class="textbox1" name="email" value="{{ old('email') }}" placeholder="demo@username.com" />
                                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                    </li>
                                    <li>
                                        <input type="password" name="password" class="textbox2" placeholder="password" />
                                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                                    </li>
                                </ul>
                                <div class="clear"></div>
                                <!-- <label class="checkbox"><input type="checkbox" name="checkbox" checked="" /><i></i>Remember me</label> -->
                                <input type="submit" name="Sign In" value="Sign In" />



                                <!-- <div class="forgot">
                                    <a href="#">forgot password?</a>
                                </div> -->
                                <div class="clear"></div>
                            </form>

                            <!-- end-form -->
                            <!-- start-account -->
                            <div class="account">
                                <h2><a href="#">Don't have an account? Sign Up!</a></h2>
                                <div class="span">
                                    <a href="#"><img src="assets/images/facebook.png" alt="" /><i>Sign In with Facebook</i>
                                        <div class="clear"></div>
                                    </a>
                                </div>
                                <div class="span2">
                                    <a href="#"><img src="assets/images/gmail.png" width="45" alt="" /><i>Sign In with Google+</i>
                                        <div class="clear"></div>
                                    </a>
                                </div>
                            </div>
                            <!-- end-account -->
                            <div class="clear"></div>

                        </div>
                        @if(session()->get('fail'))
                        <div class="alert alert-danger" role="alert">
                            {{session()->get('fail')}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>