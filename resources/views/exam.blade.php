@extends('layouts.master')

@section('content')
    <section class="dashboard_content_wrapper" id="dashboardContentArea">
        <div class="dashbaord_header_area">
            <div
                class="dashboard_title d-flex align-items-center justify-content-between flex-wrap"
            >
                <div class="topbar_title_icon_area d-flex align-items-center justify-content-between">
                    <h3>{{$data['page_title']}}</h3>
                    <svg width="36" height="27" viewBox="0 0 44 27" fill="none" xmlns="http://www.w3.org/2000/svg" id="mobileToggleIcon"><path d="M0 0.25H44V4.66667H0V0.25ZM11 11.2917H44V15.7083H11V11.2917ZM24.75 22.3333H44V26.75H24.75V22.3333Z" fill="white"></path></svg>
                </div>
                <div class="mobile_overlay_sidebar" id="mobileOverlay"></div>
                @include('layouts.topbar')
            </div>
        </div>

        <div class="food_list_area">
            <div
                class="food_list_header d-flex align-items-center justify-content-between flex-wrap"
            >
                <!-- Add Exam area Start -->
                <button type="button" data-bs-toggle="modal" data-bs-target="#addSKfModal">
                    <i class="fa-solid fa-plus"></i> <span>{{$data['add_title']}}</span>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="addSKfModal" tabindex="-1" aria-labelledby="addSKfModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal_popup_area">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h4>{{$data['add_modal_title']}}</h4>
                                <form
                                    action="{{route('exam.store')}}"
                                    class="form_area"
                                    enctype="multipart/form-data"
                                    method="post"
                                    name="add_staff"
                                >
                                    @csrf
                                    <div class="input_row">
                                        <input type="text" name="title" placeholder="Enter Exam Title..." />
                                        <div id="error_add_title"></div>
                                    </div>

                                    <div class="input_row">
                                        <input type=number step=0.01 name="exam_time" placeholder="Enter Exam Time..." />
                                        <div id="error_add_exam_time"></div>
                                    </div>

                                    <div class="input_row">
                                        <select
                                            class="js-example-basic-single"
                                            name="time_specification" id="time_specification">
                                            <option value=""></option>
                                            <option value="Hours">Hours</option>
                                            <option value="Minutes">Minutes</option>
                                            <option value="Seconds">Seconds</option>
                                        </select>
                                        <div id="error_add_time_specification"></div>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button onclick="return addExam()" type="submit" class="save_button">Save</button>
                                        <button type="button" class="cancle_button" data-bs-dismiss="modal">Cancel</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Add Exam area end -->

                <!--  Exam filter area Start -->
                <form method="get">
                    <ul class="d-flex align-items-center flex-wrap">
                        <li>
                            <div class="food_search_area">
                                <input
                                    type="text"
                                    name="search"
                                    id=""
                                    placeholder="Search Exam..."
                                />
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </li>

                        <li>
                            <button onclick="history.back()" type="button">
                                <i class="fa-solid fa-arrow-alt-circle-left"></i>
                                <span>Back</span>
                            </button>
                        </li>


                    </ul>
                </form>
                <!--  Exam filter area end -->
            </div>
            <!--  Exam list area start -->
            <div class="food_list_table table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <td>SI</td>
                        <td>Title</td>
                        <td>
                            Exam Time
                            <img
                                src="{{asset('assets/images/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                           Created By
                            <img
                                src="{{asset('assets/images/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Status
                            <img
                                src="{{asset('assets/images/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Action
                            <img
                                src="{{asset('assets/images/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                    </tr>
                    </thead>
                    <tbody>

                    @if($data['value']->count() > 0)
                        @foreach($data['value'] as $key=> $value)
                            <tr>

                                <td>{{$key + 1}}</td>
                                <td>{{$value->title}}</td>
                                <td>{{$value->exam_time.' '.$value->time_specification}}</td>
                                <td>{{$value->createdByName ? $value->createdByName->name:''}}</td>
                                <td class="status">
                                    <label class="switch">
                                        <input name="status" onchange="exam_update_status(this)" value="{{ $value->id }}" type="checkbox" @if($value->status == 'Active') checked @endif/>
                                        <span class="slider round"></span>
                                    </label>
                                </td>

                                <td class="action_button">
                                    <!-- Modal -->
                                    <div
                                        class="modal fade"
                                        id="editFoodModal{{$value->id}}"
                                        tabindex="-1"
                                        aria-labelledby="editFoodModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal_popup_area">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h4>{{$data['update_title']}}</h4>
                                                    <form
                                                        action="{{route('exam.update',$value->id)}}"
                                                        class="form_area"
                                                        enctype="multipart/form-data"
                                                        method="post"
                                                        name="edit_staff{{$value->id}}"
                                                    >
                                                        @method('put')
                                                        @csrf

                                                        <div class="input_row">
                                                            <input type="text" name="title" value="{{$value->title ?? ''}}" placeholder="Enter Exam Title..." />
                                                            <div id="error_edit_title{{$value->id}}"></div>
                                                        </div>

                                                        <div class="input_row">
                                                            <input type=number step=0.01 name="exam_time" value="{{$value->exam_time ?? ''}}" placeholder="Enter Exam Time..." />
                                                            <div id="error_edit_exam_time{{$value->id}}"></div>
                                                        </div>

                                                        <div class="input_row">
                                                            <select
                                                                class="js-example-basic-single"
                                                                name="time_specification" id="edit_time_specification{{$value->id}}">
                                                                <option @if($value->time_specification == 'Hours') selected @endif value="Hours">Hours</option>
                                                                <option @if($value->time_specification == 'Minutes') selected @endif value="Minutes">Minutes</option>
                                                                <option @if($value->time_specification == 'Seconds') selected @endif value="Seconds">Seconds</option>
                                                            </select>
                                                            <div id="error_edit_time_specification{{$value->id}}"></div>
                                                        </div>

                                                        <div class="modal-footer justify-content-center">
                                                            <button onclick="return editExam({{$value->id}})" type="submit" class="save_button">
                                                                Update
                                                            </button>
                                                            <button type="button" onclick="returnExamValue()" class="cancle_button" data-bs-dismiss="modal">Cancel</button>
                                                        </div>

                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img
                                                src="{{asset('assets/images/food/action_dot_button.svg')}}"
                                                alt=""
                                            />
                                        </button>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <button type="button" onclick="editExamSelectBox({{$value->id}})" data-bs-toggle="modal" data-bs-target="#editFoodModal{{$value->id}}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    Edit
                                                </button>
                                            </li>

                                            <li>
                                                <button onclick="deleteExam({{$value->id}})" type="button" id="">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                    Delete
                                                </button>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td  class="text-center" colspan="6">No data found</td>
                        </tr>
                    @endif

                    </tbody>
                </table>

                <!--  pagination Start -->
                {{ $data['value']->links('vendor.pagination.custom') }}
                <!--   pagination end -->
            </div>
            <!--  Exam list area end -->
        </div>
    </section>
@endsection

<script>

    function addExam(){
        var title = document.forms["add_staff"]["title"].value;
        var exam_time = document.forms["add_staff"]["exam_time"].value;
        var time_specification = document.forms["add_staff"]["time_specification"].value;

        var error_add_title = $('#error_add_title');
        var error_add_exam_time = $('#error_add_exam_time');
        var error_add_time_specification = $('#error_add_time_specification');


        if (
            title == "" ||
            exam_time == "" ||
            time_specification == ""
        )
        {
            if (title == ""){
                error_add_title.empty();
                error_add_title.append('<span style="color: red;">Tile field is required.</span');
            }
            if (title != ""){
                error_add_title.empty();
            }

            if (exam_time == ""){
                error_add_exam_time.empty();
                error_add_exam_time.append('<span style="color: red;">Exam Time field is required.</span');
            }
            if (exam_time != ""){
                error_add_exam_time.empty();
            }

            if (time_specification == ""){
                error_add_time_specification.empty();
                error_add_time_specification.append('<span style="color: red;">Time specification field is required.</span');
            }
            if (time_specification != ""){
                error_add_time_specification.empty();
            }
            return false;
        }
    }

    function editExam(id){
        var edit = 'edit_staff'+id;

        var title = document.forms[edit]["title"].value;
        var exam_time = document.forms[edit]["exam_time"].value;
        var time_specification = document.forms[edit]["time_specification"].value;

        var error_add_title = $('#error_edit_title'+id);
        var error_add_exam_time = $('#error_edit_exam_time'+id);
        var error_add_time_specification = $('#error_edit_time_specification'+id);


        if (
            title == "" ||
            exam_time == "" ||
            time_specification == ""
        )
        {
            if (title == ""){
                error_add_title.empty();
                error_add_title.append('<span style="color: red;">Tile field is required.</span');
            }
            if (title != ""){
                error_add_title.empty();
            }

            if (exam_time == ""){
                error_add_exam_time.empty();
                error_add_exam_time.append('<span style="color: red;">Exam Time field is required.</span');
            }
            if (exam_time != ""){
                error_add_exam_time.empty();
            }

            if (time_specification == ""){
                error_add_time_specification.empty();
                error_add_time_specification.append('<span style="color: red;">Time specification field is required.</span');
            }
            if (time_specification != ""){
                error_add_time_specification.empty();
            }
            return false;
        }


    }

    function returnExamValue(){
        location.reload();
    }

    function deleteExam(id){
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('{{ url('exam_delete') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                    if (data == 1){
                        Swal.fire("Deleted!", "Your data has been deleted.", "success").then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire("Error!", "Something went to wrong.", "error");
                    }

                });

            }

        });
    }

    function exam_update_status(el){
        if(el.checked){
            var status = 'Active';
        }
        else{
            var status = 'Inactive';
        }
        $.post('{{ url('exam/status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if (data == 1){
                Swal.fire("Updated!", "Status updated successfully.", "success").then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }else{
                Swal.fire("Warning!", "Something went to wrong.", "error");
            }
        });
    }

</script>

