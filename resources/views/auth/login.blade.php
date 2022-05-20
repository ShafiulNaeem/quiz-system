
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Sign In | Quiz System</title>
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
    <form method="post" action="{{ route('login') }}" class="needs-validation form_area" novalidate>
        @csrf
        <div class="form_title text-center">
            <h2>Quiz System</h2>
            <p>Please login to continue.</p>
        </div>
        <div class="input_row">
            <input
                type="text"
                placeholder="E.ID or email"
                class="form-control {{ $errors->has('phone') || $errors->has('email') ? ' is-invalid' : '' }}"
                name="login" value="{{ old('phone') ?: old('email') }}"
            />
            <img src="{{asset('assets/images/register/mail.svg')}}" alt="" />
            @if ($errors->has('login'))
                <span><strong style="color: #dc3545;">Please Enter Email or Phone Number.</strong></span>
            @endif

            @if ($errors->has('login_f'))
                <span><strong style="color: #dc3545;">{{ $errors->first('login_f') }}</strong></span>
            @endif

        </div>
        <div class="input_row">
            <input
                type="password"
                placeholder="Password"
                id="password_input1"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                value="{{ old('password')}}"
            />
{{--            <div class="invalid-feedback">Please Enter Password.</div>--}}
            <img src="{{asset('assets/images/register/lock.svg')}}" alt="" />
            <div class="password_eye_icon_area" id="password_eye_icon_area1">
                <i class="fas fa-eye eye_open" id="eyeOpen1"></i>
                <i class="fas fa-eye-slash eye_close" id="eyeClose1"></i>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
{{--                    <strong>{{ $message }}</strong>--}}
                    <strong>Please Enter Password.</strong>
                </span>
            @enderror
        </div>
        <div
            class="remeber_area d-flex align-items-center justify-content-between flex-wrap"
        >
            <div class="form-check custom_form_check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
{{--                    id="flexCheckDefault"--}}
                    name="remember"
                    id="remember" {{ old('remember') ? 'checked' : '' }}
                />
                <label class="form-check-label" for="flexCheckDefault">
                    Remember Me
                </label>
            </div>
{{--            <a href="{{ route('password.request') }}">Forgot Password?</a>--}}
        </div>
        <div class="submit_button text-center">
            <button type="submit">Sign in</button>
        </div>
    </form>
    <div class="sign_up">
        <a href="{{route('register')}}">Sign Up</a>
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

