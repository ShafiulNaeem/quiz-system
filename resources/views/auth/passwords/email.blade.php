<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Forget Password | Quiz System</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{asset('assets/images/logo_barc.png')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/fontawesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/sass/style.css')}}" />

    @toastr_css
</head>
<body>
<!-- Login Form  Section -->
<section class="login_form_wrapper">
    <form method="POST" action="{{ route('password.email') }}"
          class="needs-validation form_area" novalidate>
        @csrf
        <div class="form_title text-center">
            <h2>Quiz System</h2>
            <p>Enter email to continue.</p>
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="input_row">
            <input
                placeholder="Enter Your Email"
                id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            <img src="{{asset('assets/images/register/mail.svg')}}" alt="mail" />

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="submit_button text-center">
            <button type="submit">Forget Password</button>
        </div>
    </form>

    <div class="sign_up">
        <a href="{{route('login')}}">Sign In</a>
    </div>
</section>


<script src="{{asset('assets/plugins/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/plugins/js/bootstrap.bundle.min.js')}}"></script>
<script
    src="https://kit.fontawesome.com/46f35fbc02.js"
    crossorigin="anonymous"
></script>
<script src="{{asset('assets/plugins/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/js/chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

@toastr_js
@toastr_render
</body>
</html>

