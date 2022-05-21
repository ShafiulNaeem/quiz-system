@extends('layouts.master')

@section('content')
    <section class="dashboard_content_wrapper" id="dashboardContentArea">
        <div class="dashbaord_header_area">
            <div class="dashboard_title d-flex align-items-center justify-content-between flex-wrap">
                <div class="topbar_title_icon_area d-flex align-items-center justify-content-between">
                    <h3>Question</h3>
                    <svg width="36" height="27" viewBox="0 0 44 27" fill="none" xmlns="http://www.w3.org/2000/svg" id="mobileToggleIcon"><path d="M0 0.25H44V4.66667H0V0.25ZM11 11.2917H44V15.7083H11V11.2917ZM24.75 22.3333H44V26.75H24.75V22.3333Z" fill="white"></path></svg>
                </div>
                <div class="mobile_overlay_sidebar" id="mobileOverlay"></div>

                @include('layouts.topbar')
            </div>
        </div>

        <div class="food_list_area">
            <div class="food_list_header d-flex align-items-center justify-content-between flex-wrap">
                <h4>Add Question</h4>
                <ul class="d-flex align-items-center flex-wrap">
                    <li>
                        <button onclick="history.back()" type="button">
                            <i class="fa-solid fa-arrow-alt-circle-left"></i>
                            <span>Back</span>
                        </button>
                    </li>
                </ul>
            </div>

            <form action="{{route('question.store')}}" method="post" class="form_area email_form">

                @csrf
                <div class="input_row">
                    <label for=""><span class="label_name">Exam</span></label>
                    <select  class="js-example-basic-single" name="exam_id"  id="selectExam">
                        <option value=""></option>
                        @foreach($data['exam'] as $exam)
                            <option value="{{$exam->id}}">{{$exam->title}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('exam_id'))
                        <span class="text-danger">{{$errors->first('exam_id')}}</span>
                    @endif
                </div>

                <div class="input_row">
                    <label for=""><span class="label_name">Question</span></label>
                    <textarea type="text" class="form-control" name="title" rows="2"> {{ old('title') }} </textarea>

                    @if($errors->has('title'))
                        <span class="text-danger">Question field is required.</span>
                    @endif
                </div>

                <div class="input_row">
                    <label for=""><span class="label_name">Question Type</span></label>
                    <select  class="js-example-basic-single" onchange="questionType()" name="type"  id="question_type">
                        <option value=""></option>
                        <option value="1">Multiple Choice</option>
                        <option value="2">Written</option>
                    </select>
                    @if($errors->has('type'))
                        <span class="text-danger">{{$errors->first('type')}}</span>
                    @endif
                </div>

                <div class="col-md-12" id="options" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input_row">
                                <input type="text" class="form-control options" name="options[]" placeholder="Enter Question Option..."/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input_row">
                                <input type="text"  class="form-control options" name="options[]" placeholder="Enter Question Option..."/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input_row">
                                <input type="text" class="form-control options" name="options[]" placeholder="Enter Question Option..."/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input_row">
                                <input type="text" class="form-control options" name="options[]" placeholder="Enter Question Option..."/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="input_row">
                    <label for=""><span class="label_name">Question Answer</span></label>
                    <textarea type="text" class="form-control" name="ans" rows="2"> {{ old('ans') }} </textarea>
                    @if($errors->has('ans'))
                        <span class="text-danger">{{$errors->first('ans')}}</span>
                    @endif
                </div>

                <div class="input_row">
                    <label for=""><span class="label_name">Question Marks</span></label>
                    <input type=number step=0.01 class="form-control" name="marks" value="{{old('marks')}}" placeholder="Enter Question Marks..."/>
                    @if($errors->has('marks'))
                        <span class="text-danger">{{$errors->first('marks')}}</span>
                    @endif
                </div>

                <div class="input_row">
                    <label for=""><span class="label_name">Question Serial</span></label>
                    <input type=number step=0.01 class="form-control" name="serial" value="{{old('serial')}}" placeholder="Enter Question Serial..."/>
                    @if($errors->has('serial'))
                        <span class="text-danger">{{$errors->first('serial')}}</span>
                    @endif
                </div>

                <div class="input_row text-end">
                    <button type="submit">Add</button>
                </div>

            </form>
        </div>
    </section>
@endsection

<script>
    function questionType(){
        var question_type = $('#question_type').val();

        if(question_type == 1){
            $(".options").prop('required',true);
            $('#options').show();
        }
        else{
            $('.options').removeAttr('required');
            $('#options').hide();
        }
    }
</script>
