
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'Vehicle Reserves') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo.jpg') }}" type="image/x-icon">
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.8/dist/sweetalert2.min.css " rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo.jpg') }}" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo" style="width: 600px">
                        <a class="d-flex align-items-center " href="/"><img src="{{ asset('assets/images/logo/logo.jpg') }}" alt="Logo" class="mr-2" style="scale: 180%"> <h1 class="ms-3 mt-1">Vehicle Reserves</h1></a>
                    </div>
                    <h2 class="auth-title">Log in.</h2>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="email" type="email"
                                class="form-control form-control-xl @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password" type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have account ? <a href="{{route('register')}}"
                                class="font-bold">Register</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.8/dist/sweetalert2.all.min.js"></script>
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil disimpan',
            })
        </script>
    @elseif (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login gagal !',
                text: 'Username atau Password salah !',
            })
        </script>
    @endif
</body>

</html>
