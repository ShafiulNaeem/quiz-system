@extends('layouts.master')

@section('content')
    <section class="dashboard_content_wrapper" id="dashboardContentArea">
        <div class="dashbaord_header_area">
            <div
                class="dashboard_title d-flex align-items-center justify-content-between flex-wrap"
            >
                <div class="topbar_title_icon_area d-flex align-items-center justify-content-between">
                    <h3>Exam List</h3>
                    <svg width="36" height="27" viewBox="0 0 44 27" fill="none" xmlns="http://www.w3.org/2000/svg" id="mobileToggleIcon"><path d="M0 0.25H44V4.66667H0V0.25ZM11 11.2917H44V15.7083H11V11.2917ZM24.75 22.3333H44V26.75H24.75V22.3333Z" fill="white"></path></svg>
                </div>

                @include('layouts.topbar')

            </div>
        </div>

        <div class="food_list_area">
            <!-- data list section start -->
            <div class="food_list_table table-responsive spece_small_table">
                <table class="table">
                    <thead>
                    <tr>
                        <td>SI</td>
                        <td>
                            Name
                            <img
                                src="{{asset('assets/images/up_down_arrow.svg')}}"
                                alt="arrow"
                            />
                        </td>
                        <td>
                            ACTION<img src="{{asset('assets/images/up_down_arrow.svg')}}" alt="arrow"/>
                        </td>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>

                        <td>1212</td>
                        <td>PHP Quiz</td>
                        <td>Acton</td>

                    </tr>

                    </tbody>
                </table>
                <!--  staff pagination Start -->
            {{--                {{ $data['value']->links('vendor.pagination.custom') }}--}}
            <!--  staff pagination end -->
            </div>
            <!-- data list section start -->

        </div>
    </section>
@endsection

