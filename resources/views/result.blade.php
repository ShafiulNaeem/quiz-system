@extends('layouts.master')

@section('content')
    <section class="dashboard_content_wrapper" id="dashboardContentArea">
        <div class="dashbaord_header_area">
            <div
                class="dashboard_title d-flex align-items-center justify-content-between flex-wrap"
            >
                <div class="topbar_title_icon_area d-flex align-items-center justify-content-between">
                    <h3>Result</h3>
                    <svg width="36" height="27" viewBox="0 0 44 27" fill="none" xmlns="http://www.w3.org/2000/svg" id="mobileToggleIcon"><path d="M0 0.25H44V4.66667H0V0.25ZM11 11.2917H44V15.7083H11V11.2917ZM24.75 22.3333H44V26.75H24.75V22.3333Z" fill="white"></path></svg>
                </div>
                <div class="mobile_overlay_sidebar" id="mobileOverlay"></div>

                @include('layouts.topbar')
            </div>
        </div>

        <div class="food_list_area">
            <div class="profile_detalis_item_area">
                <div class="profile_details_inner_header d-flex align-items-center justify-content-between flex-wrap">
                    <h4>Quiz Of {{$data['result']['exam_name']}}</h4>

                    <ul class="d-flex align-items-center flex-wrap">
                        <li>
                            <a href="{{route('dashboard')}}"> Back To Quiz </a>
                        </li>
                    </ul>

                </div>
                <div class="message_details_list_area">
                    <ul>
                        <li>
                            <h3>Exam:</h3>
                            <h4>{{$data['result']['exam_name']}}</h4>
                        </li>
                        <li>
                            <p>Exam Time:</p>
                            <p>{{$data['result']['exam_time']}}</p>
                        </li>
                        <li>
                            <p>Total Point:</p>
                            <p>{{$data['result']['total_point']}}</p>
                        </li>
                        <li>
                            <p>Score:</p>
                            <p>{{$data['result']['total_marks']}}</p>
                        </li>
                        <li>
                            <p>Number of Correct Answer:</p>
                            <p>{{$data['result']['total_correct_ans']}}</p>
                        </li>
                        <li>
                            <p>Number of Wrong Answer:</p>
                            <p>{{$data['result']['total_incorrect_ans']}}</p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
@endsection
