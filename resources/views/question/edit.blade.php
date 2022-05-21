@extends('layouts.master')

@section('content')
    <section class="dashboard_content_wrapper" id="dashboardContentArea">
        <div class="dashbaord_header_area">
            <div
                class="dashboard_title d-flex align-items-center justify-content-between flex-wrap"
            >
                <div class="topbar_title_icon_area d-flex align-items-center justify-content-between">
                    <h3>Message</h3>
                    <svg width="36" height="27" viewBox="0 0 44 27" fill="none" xmlns="http://www.w3.org/2000/svg" id="mobileToggleIcon"><path d="M0 0.25H44V4.66667H0V0.25ZM11 11.2917H44V15.7083H11V11.2917ZM24.75 22.3333H44V26.75H24.75V22.3333Z" fill="white"></path></svg>
                </div>
                <div class="mobile_overlay_sidebar" id="mobileOverlay"></div>

                @include('layouts.topbar')
            </div>
        </div>

        <!-- cart area start -->
        @include('layouts.cart')
        <!-- cart area end -->

        <div class="food_list_area">
            <div class="food_list_header d-flex align-items-center justify-content-between flex-wrap">
                <h4>Send Email</h4>
                <ul class="d-flex align-items-center flex-wrap">
                    <li>
                        <button onclick="history.back()" type="button">
                            <i class="fa-solid fa-arrow-alt-circle-left"></i>
                            <span>Back</span>
                        </button>
                    </li>
                </ul>

            </div>

            <form action="{{route('message.email.send')}}" method="post"  class="form_area email_form">

                @csrf
                <div class="input_row status send_email_row">
                    <label for="">
                        <span class="label_name">Email</span>

                        <label for="" class="me-2">(All Employee)</label>
                        <label class="switch">
                            <input name="check_email"
                                   onchange="checkEmail(this)"
                                   type="checkbox"
                                @if($errors->has('all_email')) checked @endif
                            />
                            <span class="slider round"></span>
                        </label>
                    </label>

                    <div
                        @if($errors->has('all_email'))
                            style="display: block;"
                        @else
                            style="display: none;"
                        @endif
                         id="showHideDiv">

                        <select  class="js-example-basic-single" name="all_email[]" multiple="multiple" id="userEmail">
                            @foreach($data['employee'] as $employee)
                                <option value="{{$employee->email}}">{{$employee->email}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('all_email'))
                            <span class="text-danger">Email field is required.</span>
                        @endif
                    </div>

                </div>

                <input hidden type="text" name="email" value="{{$data['value']->user?$data['value']->user->email:''}}">
                <div class="input_row">
                    <label for="">
                        <span class="label_name"> Subject</span>
                    </label>

                    <input type="text" value="{{ old('subject') }}" name="subject" placeholder="Enter Your Subject" />
                    @if($errors->has('subject'))
                        <span class="text-danger">{{$errors->first('subject')}}</span>
                    @endif

                </div>

                <div class="input_row">
                    <textarea id="summernote" name="message">{{ old('message') }}</textarea>
                    @if($errors->has('message'))
                        <span class="text-danger">{{$errors->first('message')}}</span>
                    @endif
                </div>

                <div class="input_row text-end">
                    <button type="submit">Send</button>
                </div>

            </form>
        </div>
    </section>
@endsection

<script>
   function checkEmail(el){
       var all_email = document.getElementById("showHideDiv");
       if(el.checked){
           all_email.style.display = "block";
       }
       else{
           all_email.style.display = "none";
       }
   }
</script>
