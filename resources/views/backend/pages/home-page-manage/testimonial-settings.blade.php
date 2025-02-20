@extends('backend.admin-master')
@section('site-title')
    {{__('Testimonial Area Settings')}}
@endsection
@section('style')
<x-datatable.css/>
<x-media.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Testimonial Area Settings')}}</h4>
                        <form action="{{route('admin.home.testimonial')}}" method="post" enctype="multipart/form-data">@csrf
                            <x-lang-nav/>
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_testimonial_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" name="home_page_testimonial_section_{{$lang->slug}}_title" value="{{get_static_option('home_page_testimonial_section_'.$lang->slug.'_title')}}" placeholder="{{__('Title')}}">
                                    </div>
                                </div>
                               @endforeach
                            </div>
                            <button type="submit" id="update" class="btn btn-primary pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('script')
<x-datatable.js/>
<x-media.js/>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-btn.update/>
        });
        })(jQuery);
    </script>
@endsection
