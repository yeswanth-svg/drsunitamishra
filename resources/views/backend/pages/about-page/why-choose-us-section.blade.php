@extends('backend.admin-master')
@section('site-title')
    {{__('Why Choose Us Section')}}
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Why Choose Us Section Settings')}}</h4>
                        <form action="{{route('admin.about.whychoose')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="price_plan">{{__('Select Services to Display')}}</label>
                                <select name="about_page_why_choose_us_selected_service_ids[]" multiple class="form-control nice-select wide">
                                    @php
                                        $selected_service = !empty(get_static_option('about_page_why_choose_us_selected_service_ids')) ? unserialize(get_static_option('about_page_why_choose_us_selected_service_ids')) : [];
                                    @endphp
                                    @foreach($all_services as $data)
                                        <option value="{{$data->id}}" @if(is_array($selected_service) && in_array($data->id,$selected_service)) selected @endif>{{$data->lang->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
<script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
    (function($){
            "use strict";
            $(document).ready(function () {
                if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
                }
                <x-btn.update/>
            })
        })(jQuery);
    </script>
@endsection
