@extends('backend.admin-master')
@section('site-title')
    {{__('Full Width Service Settings')}}
@endsection
@section('style')
<x-media.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Full Width Service Settings')}}</h4>
                        <form action="{{route('admin.home.full.width.service')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('backend.partials.languages-nav')
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_full_width_service_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" name="home_page_full_width_service_section_{{$lang->slug}}_title" value="{{get_static_option('home_page_full_width_service_section_'.$lang->slug.'_title')}}" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_full_width_service_section_{{$lang->slug}}_description">{{__('Description')}}</label>
                                        <textarea type="text" class="form-control" name="home_page_full_width_service_section_{{$lang->slug}}_description" rows="4" cols="10">{{get_static_option('home_page_full_width_service_section_'.$lang->slug.'_description')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_full_width_service_section_{{$lang->slug}}_features">{{__('Features')}}</label>
                                        <textarea class="form-control"  id="home_page_full_width_service_section_{{$lang->slug}}_features"  name="home_page_full_width_service_section_{{$lang->slug}}_features" placeholder="{{__('Features')}}" cols="10" rows="5">{{get_static_option('home_page_full_width_service_section_'.$lang->slug.'_features')}}</textarea>
                                        <small class="form-text text-muted">{{__('Separate feature by entering a new line.')}}</small> 
                                    </div>
                                    @if($home_page_variant_number != '02')
                                    <div class="form-group">
                                        <label for="home_page_full_width_service_section_{{$lang->slug}}_support_title">{{__('Support Title')}}</label>
                                        <input type="text" class="form-control" name="home_page_full_width_service_section_{{$lang->slug}}_support_title" value="{{get_static_option('home_page_full_width_service_section_'.$lang->slug.'_support_title')}}" placeholder="{{__('Support Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_full_width_service_section_{{$lang->slug}}_support_details">{{__('Support Details')}}</label>
                                        <input type="text" class="form-control" name="home_page_full_width_service_section_{{$lang->slug}}_support_details" value="{{get_static_option('home_page_full_width_service_section_'.$lang->slug.'_support_details')}}" placeholder="{{__('Support Details')}}">
                                    </div>
                                    @endif
                                    @if($home_page_variant_number == '01')
                                    <div class="form-group">
                                        <label for="home_page_full_width_service_section_{{$lang->slug}}_support_description">{{__('Support Description')}}</label>
                                        <textarea type="text" class="form-control" name="home_page_full_width_service_section_{{$lang->slug}}_support_description" rows="3" cols="10">{{get_static_option('home_page_full_width_service_section_'.$lang->slug.'_support_description')}}</textarea>
                                    </div>
                                    @endif
                                </div>
                               @endforeach
                            </div>
                            @if($home_page_variant_number != '02')
                            <x-add-icon :name="'home_page_full_width_service_section_support_icon'" :id="'home_page_full_width_service_section_support_icon'" :value="'home_page_full_width_service_section_support_icon'" :title="__('Support Icon')"/>
                            @endif
                            <div class="row">
                                @if($home_page_variant_number != '04')
                                <div class="form-group col-md-3">
                                    <label for="image">{{__('Background Image')}}</label>
                                    <x-image :id="'home_page_full_width_service_section_'.$home_page_variant_number.'_bg_img'" :name="'home_page_full_width_service_section_'.$home_page_variant_number.'_bg_img'" :value="'home_page_full_width_service_section_'.$home_page_variant_number.'_bg_img'"/>
                                    <small class="form-text text-muted">{{__('1150 x 800 pixels (recommended)')}}</small>
                                </div>
                                @endif
                                <div class="form-group col-md-3">
                                    <label for="image">{{__('Right Side Image')}}</label>
                                    <x-image :id="'home_page_full_width_service_section_'.$home_page_variant_number.'_bg_img_right'" :name="'home_page_full_width_service_section_'.$home_page_variant_number.'_bg_img_right'" :value="'home_page_full_width_service_section_'.$home_page_variant_number.'_bg_img_right'"/>
                                    <small class="form-text text-muted">{{__('1050 x 850 pixels (recommended)')}}</small>
                                </div>
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
<x-media.js/>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-btn.update/>
            <x-icon-picker/>
        });
        })(jQuery);
    </script>
@endsection
