<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="website for management " />
    <meta name="author" content="May Mayou JCD" />
    <title>MAY MAYOU JCD - Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/siqtheme.css') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">
</head>

<body class="theme-default">

    <div class="login-wrapper">
        <div class="d-flex justify-content-center mt-5">
            <div class="card" id="login-card">
                <div class="card-body text-center">
                    <h3><span class="text-carolina bold">MMY</span>JCD</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('auth.authenticate') }}" method="POST">
                        @csrf
                        <div class="text-center pb-3">
                            <h5 class="text-center bold">Sign-In</h5>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-email"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="password">
                            @error('password')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-checkbox">
                            <label>
                                <input type="checkbox" name="remember">
                                <span class="checkmark"><i class="ti-check"></i></span>
                                Remember
                            </label>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-carolina">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/scripts/siqtheme.js') }}"></script>
    <script src="{{ asset('assets/scripts/pages/pg_login.js') }}" type="text/javascript"></script>
</body>
</html>