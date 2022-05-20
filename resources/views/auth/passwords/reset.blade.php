
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Reset Password | Quiz System</title>
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

    <form method="post" action="{{  route('password.update') }}" class="needs-validation form_area" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form_title text-center">
            <h2>Quiz System</h2>
            <p>Reset Password.</p>
        </div>

        <div class="input_row">

            <input id="email" type="email"
                   placeholder="Email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ $email ?? old('email') }}"
                   required autocomplete="email" autofocus>
            <img src="{{asset('assets/images/register/mail.svg')}}" alt="" />

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="input_row">
            <input id="password_input1"
                   placeholder="Password"
                   type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">

            <img src="{{asset('assets/images/register/lock.svg')}}" alt="" />
            <div class="password_eye_icon_area" id="password_eye_icon_area1">
                <i class="fas fa-eye eye_open" id="eyeOpen1"></i>
                <i class="fas fa-eye-slash eye_close" id="eyeClose1"></i>
            </div>

            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input_row">
            <input name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror"
                type="password"
                value="{{ old('password_confirmation') }}"
                placeholder="Enter Confirm Password"
                id="password_input2"
            />
            <img src="{{asset('assets/images/register/lock.svg')}}" alt="" />
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="password_eye_icon_area" id="password_eye_icon_area2">
                <i class="fas fa-eye eye_open" id="eyeOpen2"></i>
                <i class="fas fa-eye-slash eye_close" id="eyeClose2"></i>
            </div>
        </div>

        <div class="submit_button text-center">
            <button type="submit">Reset Password</button>
        </div>
    </form>
    <div class="sign_up">
        <a href="{{route('login')}}">Sign in</a>
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


