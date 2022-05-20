<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Sign Up |Quiz System</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{asset('assets/images/logo_barc.png')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/sass/style.css')}}" />

    @toastr_css
</head>
<body>
<!-- Login Form  Section -->
<section class="login_form_wrapper sign_up_form_wrapper">
    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" class="needs-validation form_area" novalidate>
        @csrf
        <div class="form_title text-center">
            <h2>Quiz System</h2>
            <p>Please Sign Up to continue.</p>
        </div>
        <div class="input_row">
            <input class="@error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Enter Your Name"/>

            @error('name')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
        <div class="input_row">
            <input class="@error('email') is-invalid @enderror" value="{{ old('email') }}" type="email" name="email" placeholder="Enter Your Email" />

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
        <div class="input_row">
            <input
                class="@error('password') is-invalid @enderror"
                type="password"
                name="password"
                value="{{ old('password') }}"
                placeholder="Enter Password"
                id="password_input1"
            />

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="password_eye_icon_area" id="password_eye_icon_area1">
                <i class="fas fa-eye eye_open" id="eyeOpen1"></i>
                <i class="fas fa-eye-slash eye_close" id="eyeClose1"></i>
            </div>
        </div>
        <div class="input_row">
            <input
                name="password_confirmation"
                class="@error('password_confirmation') is-invalid @enderror"
                type="password"
                value="{{ old('password_confirmation') }}"
                placeholder="Enter Confirm Password"
                id="password_input2"
            />

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

        <div class="input_row">
            <input
                class="@error('phone') is-invalid @enderror"
                name="phone"
                type="text"
                value="{{ old('phone') }}"
                placeholder="Enter Your Phone Number."
            />

            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <div class="submit_button text-center">
            <button type="submit">Sign Up</button>
        </div>
    </form>
    <div class="sign_up">
        Do You Have Account?
        <a href="{{route('login')}}">
            Sign In</a>
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
<script src="{{asset('assets/js/main.js')}}"></script>

@toastr_js
@toastr_render
</body>
</html>

