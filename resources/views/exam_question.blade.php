@extends('layouts.master')

@section('content')
    <section class="dashboard_content_wrapper" id="dashboardContentArea">
        <div class="dashbaord_header_area">
            <div
                class="dashboard_title d-flex align-items-center justify-content-between flex-wrap"
            >
                <div class="topbar_title_icon_area d-flex align-items-center justify-content-between">
                    <h3>Quiz Question</h3>
                    <svg width="36" height="27" viewBox="0 0 44 27" fill="none" xmlns="http://www.w3.org/2000/svg" id="mobileToggleIcon"><path d="M0 0.25H44V4.66667H0V0.25ZM11 11.2917H44V15.7083H11V11.2917ZM24.75 22.3333H44V26.75H24.75V22.3333Z" fill="white"></path></svg>
                </div>
                <div class="mobile_overlay_sidebar" id="mobileOverlay"></div>

                @include('layouts.topbar')
            </div>
        </div>

        <div class="food_list_area">
            <div class="profile_detalis_item_area">
                <div class="profile_details_inner_header d-flex align-items-center justify-content-between flex-wrap">
                    <h4>{{$data['exam']->title}}</h4>
                    <p>
                        Time: {{$data['exam']->exam_time}} <span>{{$data['exam']->time_specification}}</span>
                    </p>

                </div>
                <div class="message_details_list_area">
                    <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">

                        <div class="carousel-inner">

                            @foreach($data['question'] as $key => $question)
                                <div class="carousel-item @if($key == 0) active @endif">

                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text"> <strong>Question  </strong>{{$key+1}} of {{$data['question']->count()}}</p>
                                        <br>
                                        <p class="card-text">{{$question->title}}</p>
                                        <br>

                                        <div class="input_row">

                                            @if($question->type == 'Multiple Choice')
                                                @foreach($question->questionBodies as $option)
                                                    <div class="form-check">
                                                        <input class="form-check-input" onclick="nextButtonDisableFalse()" type="radio"
                                                               name="ans"
                                                               value="{{$option->input_name}}"
                                                               id="flexRadioDefault{{$option->id}}" >

                                                        <label class="form-check-label" for="flexRadioDefault{{$option->id}}">
                                                            {{$option->input_name}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach($question->questionBodies as $option)
                                                    <label for=""><span class="label_name">Answer</span></label>
                                                    <textarea type="text" onkeyup="nextDisableFalse()" id="text_ans" class="form-control" name="ans" rows="2"> </textarea>
                                                @endforeach
                                            @endif

                                        </div>

                                    </div>

                                </div>
                            @endforeach


                        </div>

                        <button disabled="true" class="btn btn-primary" id="next_question" onclick="nextQuestion()"
                                type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                            Next
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

<script>
    function nextDisableFalse(){
        var text_ans = $('#text_ans').val();
        text_ans = text_ans.trim();
        if (text_ans !=''){
            $('#next_question').attr("disabled",false);
        }else {
            $('#next_question').attr("disabled",true);
        }
        console.log(email);
    }

    function nextButtonDisableFalse(){
        $('#next_question').attr("disabled",false);
    }

    function nextQuestion(){
        var email = $('#email1').val();
        var next = $('#next_question');
        console.log(email);

        $('#next_question').attr("disabled",true);
    }
</script>
