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

                <!-- filter area start -->
                <ul class="d-flex align-items-center flex-wrap">
                    <li>   <a href="{{route('message.create')}}">
                <i class="fa-brands fa-telegram"></i> <span> Send Message </span>
                </a></li>
                    <li>
                        <form method="get" name="report_filter_search" id="report_filter_search">
                            <div style="padding-top: 14px" class="food_search_area">
                                <input type="text" name="search" id="" placeholder="Search user name"/>
                                <i style="padding-top: 14px" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </form>
                    </li>

                    <li>
                        <form method="get" name="report_filter_form" id="report_filter_form">
                            <div style="padding-top: 14px" class="date_picker_area">
                                <input type="number" placeholder="Select Date"
                                       id="reportrange"
                                       name="date"
                                       class="report_date"
                                       onfocus = "(this.type='text')">
                                <i style="padding-top: 14px" class="fa fa-calendar"></i>
                            </div>
                        </form>

                    </li>

                    <li>
                        <div>
                            <button onclick="dateFilterSearch()" type="submit">Go</button>
                        </div>

                    </li>

                    <li>
                        <button onclick="history.back()" type="button">
                            <i class="fa-solid fa-arrow-alt-circle-left"></i>
                            <span>Back</span>
                        </button>

                    </li>

                    <li>
                        <a style=" border-radius: 7px;
                            padding: 10px 25px;border: 1px solid #7764e4 !important;
                            background-color: transparent;
                            -webkit-border-radius: 7px;
                            -moz-border-radius: 7px;
                            -ms-border-radius: 7px;
                            -o-border-radius: 7px;
                            cursor: pointer;
                            display: inline-block;"
                           href="{{route('export_message')}}">
                            <i class="fa-solid fa-file-export"></i>
                            <span>Export Data</span>
                        </a>
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
                            Date
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>

                        <td>
                            Name
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            SKF E.ID
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Email
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Mobile
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Subject
                            <img
                                src="{{asset('assets/images/food/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            Message
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
                                    <td>
                                        {{\Carbon\Carbon::parse($value->created_at ?? '')
                                            ->format('F j, Y,g:i:s a', time() - 6*3600)}}
                                    </td>
                                    <td>{{$value->user_id?$value->user->name:''}}</td>
                                    <td>{{$value->user_id?$value->user->skf_employee_id:''}}</td>
                                    <td><a href="{{route('message.email',$value->id)}}">{{$value->user_id?$value->user->email:''}}</a></td>
                                    <td><a href="tel:+{{$value->user_id?$value->user->phone:''}}">{{$value->user_id?$value->user->phone:''}}</a></td>
                                    <td>{{$value->subject}}</td>
                                    <td>{!! $value->message !!}</td>
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
                                                <li>
                                                    <a href="{{route('message.show',$value->id)}}">
                                                        <i class="fa-solid fa-eye"></i>
                                                        View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('message.email',$value->id)}}">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        Email
                                                    </a>
                                                </li>

                                                <li>
                                                    <button type="button" onclick="deleteMessage({{$value->id}})" id="">
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
                <!--  staff pagination Start -->
                {{ $data['value']->withQueryString()->links('vendor.pagination.custom') }}
                <!--  staff pagination end -->

            </div>
            <!-- list area end -->
        </div>
    </section>
@endsection


<script>
    function deleteMessage(id){
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
                $.post('{{ url('message_delete') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
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

    function dateFilterSearch(){
        var date = $('.report_date').val();
        if (date == ''){
            Swal.fire("Error!", "Date field is empty.", "error");
        }else {
            $('#report_filter_form').submit();
        }

    }
</script>
