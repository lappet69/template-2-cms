<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('back/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('back/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/css/inventory.css') }}">
</head>

<body class="hold-transition bg-login">
    <img src="{{ asset('front/assets/img/academy-logo.png') }}" alt="Logo" class="login-box-msg">
    <div class="login-box">

        <form method="POST" action="{{ route('actionlogin') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                    style="border: 1px solid var(--primary);">
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" style="border: 1px solid var(--primary);">
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-inventory btn-block">Log In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('back/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('back/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- back/adminlte App -->
    <script src="{{ asset('back/adminlte/dist/js/back/adminlte.min.js') }}"></script>
</body>

</html>
