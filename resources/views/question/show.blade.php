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

        <div class="food_list_area">
            <div class="profile_detalis_item_area">
                <div class="profile_details_inner_header d-flex align-items-center justify-content-between flex-wrap">
                    <h4>Message Of {{$data['value']->user?$data['value']->user->name:'' }}</h4>

                    <ul class="d-flex align-items-center flex-wrap">
                        <li>
                            <a href="{{route('message.email',$data['value']->id)}}"> Email </a>
                        </li>
                        <li>
                            <button onclick="history.back()" type="button">
                                <i class="fa-solid fa-arrow-alt-circle-left"></i>
                                <span>Back</span>
                            </button>
                        </li>
                    </ul>

                </div>
                <div class="message_details_list_area">
                    <ul>
                        <li>
                            <h3>Subject:</h3>
                            <h4>{{$data['value']->subject}}</h4>
                        </li>
                        <li>
                            <p>Name:</p>
                            <p>{{$data['value']->user?$data['value']->user->name:'' }}</p>
                        </li>
                        <li>
                            <p>Email:</p>
                            <p>{{$data['value']->user?$data['value']->user->email:'' }}</p>
                        </li>
                        <li>
                            <p>Mobile:</p>
                            <p>{{$data['value']->user?$data['value']->user->phone:'' }}</p>
                        </li>
{{--                        <li>--}}
{{--                            <p>Order Number:</p>--}}
{{--                            <p>{{$data['value']->user?$data['value']->user->name:'' }}</p>--}}
{{--                        </li>--}}
                        <li>
                            <p>Message:</p>
                            {!! $data['value']->message !!}
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
@endsection
