@extends('layouts.master')

@section('content')
    <section class="dashboard_content_wrapper" id="dashboardContentArea">
        <div class="dashbaord_header_area">
            <div
                class="dashboard_title d-flex align-items-center justify-content-between flex-wrap"
            >
                <div class="topbar_title_icon_area d-flex align-items-center justify-content-between">
                    <h3>Question List</h3>
                    <svg width="36" height="27" viewBox="0 0 44 27" fill="none" xmlns="http://www.w3.org/2000/svg" id="mobileToggleIcon"><path d="M0 0.25H44V4.66667H0V0.25ZM11 11.2917H44V15.7083H11V11.2917ZM24.75 22.3333H44V26.75H24.75V22.3333Z" fill="white"></path></svg>
                </div>
                <div class="mobile_overlay_sidebar" id="mobileOverlay"></div>

                @include('layouts.topbar')
            </div>
        </div>


        <div class="food_list_area">
            <div class="food_list_header d-flex align-items-center justify-content-between flex-wrap">
                <a href="{{route('question.create')}}">
                    <i class="fa-solid fa-plus"></i></i>
                    <span> Add Question </span>
                </a>
                <!-- filter area start -->
                <ul class="d-flex align-items-center flex-wrap">
                    <li>
                        <form method="get" name="report_filter_search" id="report_filter_search">
                            <div style="padding-top: 14px" class="food_search_area">
                                <input type="text" name="search" id="" placeholder="Search Question..."/>
                                <i style="padding-top: 14px" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </form>
                    </li>

                    <li>
                        <button onclick="history.back()" type="button">
                            <i class="fa-solid fa-arrow-alt-circle-left"></i>
                            <span>Back</span>
                        </button>

                    </li>
                </ul>
                <!-- filter area end -->
            </div>

            <!-- list area start -->
            <div class="food_list_table table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <td>SI</td>
                        <td>
                            Exam
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>

                        <td>
                            Question
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Type
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Answer
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Marks
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Status
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Created By
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>

                        <td>
                            ACTION
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
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
                                    <td>{{$value->exam?$value->exam->title:''}}</td>
                                    <td>{{$value->title}}</td>
                                    <td>{{$value->type}}</td>
                                    <td>{{$value->ans}}</td>
                                    <td>{{$value->marks}}</td>

                                    <td class="status">
                                        <label class="switch">
                                            <input name="status" onchange="question_update_status(this)" value="{{ $value->id }}" type="checkbox" @if($value->status == 'Active') checked @endif/>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>

                                    <td>{{$value->createdByName?$value->createdByName->name:''}}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button
                                                class="dropdown-toggle"
                                                type="button"
                                                id="dropdownMenuButton1"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                            >
                                                <img
                                                    src="{{asset('assets/images//food/action_dot_button.svg')}}"
                                                    alt=""
                                                />
                                            </button>

                                            <ul
                                                class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton1"
                                            >
{{--                                                <li>--}}
{{--                                                    <a href="{{route('question.show',$value->id)}}">--}}
{{--                                                        <i class="fa-solid fa-eye"></i>--}}
{{--                                                        View--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
                                                <li>
                                                    <a href="{{route('question.edit',$value->id)}}">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        Edit
                                                    </a>
                                                </li>

                                                <li>
                                                    <button type="button" onclick="deleteQuestion({{$value->id}})" id="">
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
                                <td  class="text-center" colspan="9">No data found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <!--   pagination Start -->
                {{ $data['value']->withQueryString()->links('vendor.pagination.custom') }}
                <!--  pagination end -->

            </div>
            <!-- list area end -->
        </div>
    </section>
@endsection


<script>
    function deleteQuestion(id){
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
                $.post('{{ url('question_delete') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                    if (data == 1){
                        Swal.fire("Deleted!", "Your file has been deleted.", "success").then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire("Error!", "Something went to wrong.", "error");
                    }
                    // location.reload();
                });

            }

        });
    }

    function question_update_status(el){
        if(el.checked){
            var status = 'Active';
        }
        else{
            var status = 'Inactive';
        }
        $.post('{{ url('question/status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
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
