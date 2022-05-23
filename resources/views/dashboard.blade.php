@extends('layouts.master')

@section('content')
    <section class="dashboard_content_wrapper" id="dashboardContentArea">
        <div class="dashbaord_header_area">
            <div
                class="dashboard_title d-flex align-items-center justify-content-between flex-wrap"
            >
                <div class="topbar_title_icon_area d-flex align-items-center justify-content-between">
                    <h3>Quiz</h3>
                    <svg width="36" height="27" viewBox="0 0 44 27" fill="none" xmlns="http://www.w3.org/2000/svg" id="mobileToggleIcon"><path d="M0 0.25H44V4.66667H0V0.25ZM11 11.2917H44V15.7083H11V11.2917ZM24.75 22.3333H44V26.75H24.75V22.3333Z" fill="white"></path></svg>
                </div>
                <div class="mobile_overlay_sidebar" id="mobileOverlay"></div>

                @include('layouts.topbar')
            </div>
        </div>

        <div class="food_list_area">
            <div class="profile_detalis_item_area">
                <div class="profile_details_inner_header d-flex align-items-center justify-content-between flex-wrap">
                    <h4>Quizzes</h4>
                    <p>
                        Chose your subject.
                    </p>

                </div>
                <div class="message_details_list_area">
                    <br>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($data['value'] as $key=>$value)
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$value->title}}</h5>
                                        <p class="card-text"> <strong>Exam Time: </strong> {{$value->exam_time.' '.$value->time_specification}}</p>
                                        <p class="card-text"> <strong>Questions: </strong> {{$value->questions->count()}}</p>
                                        <br>
                                        <a @if($value->questions->count() != 0)
                                           href="{{route('exam.question',$value->id)}}"
                                           @endif
                                           class="btn btn-success"
                                        >Start Quiz</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
