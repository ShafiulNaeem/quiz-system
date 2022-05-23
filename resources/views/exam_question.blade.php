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

                    <div id="countdowntimer">
                        <span id="demo"><span>
                    </div>

                    <ul class="d-flex align-items-center flex-wrap">
                        <li>
                            <a href="{{route('dashboard')}}"> Back To Quiz </a>
                        </li>
                    </ul>

                </div>
                <div class="message_details_list_area">
                    <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">

                        <div class="carousel-inner">

                            <input type="text" hidden name="current_question_id" id="current_question_id" value="">
                            <input type="text" hidden name="current_option_id" id="current_option_id" value="">
                            <input type="text" hidden name="exam_id" id="exam_id" value="{{$data['exam']->id}}">
                            <input type="text" hidden name="participation_number" id="participation_number" value="{{$data['participation_number']}}">

                            @foreach($data['question'] as $key => $question)
                                <div class="carousel-item @if($key == 0) active @endif">

                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text"> <strong>Question  </strong>{{$key+1}} of {{$data['question']->count()}}</p>
                                        <br>
                                        <p class="card-text">{{$question->title}}</p>
                                        <br>

                                        <div class="input_row">

                                            <input type="text" hidden name="type" id="type{{$question->id}}" value="{{$question->type}}">
                                            <input type="text" hidden name="number_of_question" id="number_of_question{{$question->id}}" value="{{$key+1}}">
                                            <input type="text" hidden name="total_question" id="total_question" value="{{$data['question']->count()}}">


                                            @if($question->type == 'Multiple Choice')
                                                @foreach($question->questionBodies as $option)

                                                    <div class="form-check">
                                                        <input class="form-check-input" onclick="nextButtonDisableFalse({{$option}})"
                                                               value="{{$option->input_name}}"
                                                               type="radio"
                                                               option_id="{{$option->id}}"
                                                               name="ans"
                                                               id="ans{{$option->id}}">
                                                        <label class="form-check-label" for="flexRadioDefault1{{$option->id}}">
                                                            {{$option->input_name}}
                                                        </label>
                                                    </div>

                                                @endforeach
                                            @else
                                                @foreach($question->questionBodies as $option)
                                                    <label for=""><span class="label_name">Answer</span></label>
                                                    <textarea type="text" onkeyup="nextDisableFalse({{$option}})"
                                                              id="ans{{$option->id}}"
                                                              option_id="{{$option->id}}"
                                                              class="form-control" name="ans" rows="2"> </textarea>
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
{{--<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}
<script>

    // setInterval(function(){
    //
    //     var hr = 3;
    //     var mm = 3;
    //     var ss = 3;
    //
    //     if(hr == 0 && mm == 0 && ss == 0)clearInterval(interval);
    //     ss--;
    //     if(ss == 0)
    //     {
    //         ss = 59;
    //         mm--;
    //         if(mm == 0)
    //         {
    //             mm = 59;
    //             hr--;
    //         }
    //     }
    //
    //     if(hr.toString().length < 2) hr = "0"+hr;
    //     if(mm.toString().length < 2) mm = "0"+mm;
    //     if(ss.toString().length < 2) ss = "0"+ss;
    //     $("#demo").html(hr+" : "+mm+" : "+ss);
    //
    // },1000)

    // setInterval(function() {
    //     date = new Date()
    //     let hour = 20;
    //     console.log(hour);
    //     let minutes = 1;
    //     let seconds = date.getSeconds();
    //     document.getElementById("demo").innerHTML = hour + ":"+ minutes + ":" + seconds;
    // }, 1000);

    function nextDisableFalse(option){
        var text_ans = $('#ans'+option.id).val();
        text_ans = text_ans.trim();
        if (text_ans !=''){
            $('#next_question').attr("disabled",false);
            $('#current_question_id').val(option.question_id);
            $('#current_option_id').val(option.id);
        }else {
            $('#next_question').attr("disabled",true);
        }

    }

    function nextButtonDisableFalse(option){
        var fh = '<?php echo route('result',3) ?>'+'/'+3;
        console.log(fh);

        $('#next_question').attr("disabled",false);
        $('#current_question_id').val(option.question_id);
        $('#current_option_id').val(option.id);
    }

    function nextQuestion(){

        var question_id = $('#current_question_id').val();
        var option_id = $('#current_option_id').val();
        var exam_id = $('#exam_id').val();
        var participation_number = $('#participation_number').val();
        var ans = $('#ans'+option_id).val();
        var number_of_question = $('#number_of_question'+question_id).val();
        var total_question = $('#total_question').val();

        $.ajax({
            url: '{{ route('question.ans') }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                exam_id: exam_id,
                question_id: question_id,
                question_body_id: option_id,
                participation_number: participation_number,
                ans: ans,
            },
            success: function (response){
                // console.error(response);
                // toastr.success(response['message']);

            },
            error : function (error){
                console.error(error);
            }
        });


        if (number_of_question == total_question){
            window.location.href = '<?php echo route('result',$data['participation_number']) ?>';
        }

        var break_point = total_question-1;
        if (number_of_question == break_point){
            $('#next_question').attr("data-bs-slide","1234");
        }

        $('#next_question').attr("disabled",true);
    }
</script>
