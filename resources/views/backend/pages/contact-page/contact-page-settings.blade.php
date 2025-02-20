@extends('backend.admin-master')
@section('site-title')
    {{__('Contact Page Settings')}}
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
                        <h4 class="header-title">{{__('Contact Page Settings')}}</h4>
                        <form action="{{route('admin.contact.page.settings')}}" method="post" enctype="multipart/form-data">@csrf
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <x-lang-nav/>
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_contact_us_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" name="home_page_contact_us_section_{{$lang->slug}}_title" class="form-control" placeholder="{{__('Title')}}" value="{{get_static_option('home_page_contact_us_section_'.$lang->slug.'_title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_contact_us_section_{{$lang->slug}}_contact">{{__('Contact No')}}</label>
                                        <textarea class="form-control" name="home_page_contact_us_section_{{$lang->slug}}_contact" placeholder="{{__('Contact No')}}" cols="5" rows="5">{{get_static_option('home_page_contact_us_section_'.$lang->slug.'_contact')}}</textarea>
                                        <small class="form-text text-muted">{{__('Separate item by entering a new line.')}}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_contact_us_section_{{$lang->slug}}_email">{{__('Email')}}</label>
                                        <textarea class="form-control" name="home_page_contact_us_section_{{$lang->slug}}_email" placeholder="{{__('Email')}}" cols="5" rows="5">{{get_static_option('home_page_contact_us_section_'.$lang->slug.'_email')}}</textarea>
                                        <small class="form-text text-muted">{{__('Separate item by entering a new line.')}}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_contact_us_section_{{$lang->slug}}_address">{{__('Address')}}</label>
                                        <textarea class="form-control" name="home_page_contact_us_section_{{$lang->slug}}_address" placeholder="{{__('Email')}}" cols="5" rows="5">{{get_static_option('home_page_contact_us_section_'.$lang->slug.'_address')}}</textarea>
                                        <small class="form-text text-muted">{{__('Separate item by entering a new line.')}}</small>
                                    </div>
                                </div>
                               @endforeach
                            </div>
                            <div class="form-group">
                                <label for="contact_page_map_section_location">{{__('Google Map Location')}}</label>
                                <input type="text" name="contact_page_map_section_location" value="{{get_static_option('contact_page_map_section_location')}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="contact_page_map_section_zoom">{{__('Map Zoom')}}</label>
                                <input type="text" name="contact_page_map_section_zoom" value="{{get_static_option('contact_page_map_section_zoom')}}" class="form-control" >
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-btn.update/>
        });
        })(jQuery);
    </script>
@endsection