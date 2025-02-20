@extends('backend.admin-master')
@section('site-title')
    {{__('Key Features Settings')}}
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
                        <h4 class="header-title">{{__('Keyfeatures Area Settings')}}</h4>
                        <form action="{{route('admin.home.keyfeatures')}}" method="post" enctype="multipart/form-data">@csrf
                            <x-lang-nav/>
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    @if(in_array($home_page_variant_number,['02','04']))
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_{{$lang->slug}}_title" value="{{get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_title')}}" placeholder="{{__('Title')}}">
                                    </div>
                                    @endif
                                    @if($home_page_variant_number == '02')
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_{{$lang->slug}}_btn_text">{{__('Button Text')}}</label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_{{$lang->slug}}_btn_text" value="{{get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_btn_text')}}" placeholder="{{__('Button Text')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_{{$lang->slug}}_btn_url">{{__('Button Url')}}</label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_{{$lang->slug}}_btn_url" value="{{get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_btn_url')}}" placeholder="{{__('Button Url')}}">
                                    </div>
                                    @endif
                                    @if($home_page_variant_number == '04')
                                    <div class="form-group">    
                                        <label for="home_page_keyfeatures_section_{{$lang->slug}}_description">{{__('Description')}}</label>
                                        <textarea type="text" class="form-control" name="home_page_keyfeatures_section_{{$lang->slug}}_description" value="{{get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_description')}}" rows="5" cols="10">{{get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_description')}}</textarea>
                                    </div>
                                    @endif
                                    @if($home_page_variant_number == '03')
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_{{$lang->slug}}_quote_title">{{__('Quote Title')}}</label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_{{$lang->slug}}_quote_title" value="{{get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_quote_title')}}" placeholder="{{__('Quote Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_{{$lang->slug}}_quote_subtitle">{{__('Quote Sub Title')}}</label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_{{$lang->slug}}_quote_subtitle" value="{{get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_quote_subtitle')}}" placeholder="{{__('Quote Sub Title')}}">
                                    </div>
                                    @endif
                                </div>
                               @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_{{$home_page_variant_number}}_key_feature_item">{{__('Display Number of Items')}}</label>
                                <input type="number" name="home_page_{{$home_page_variant_number}}_key_feature_item" value="{{get_static_option('home_page_'.$home_page_variant_number.'_key_feature_item')}}" class="form-control" id="home_page_{{$home_page_variant_number}}_key_feature_item">
                            </div>
                            @if(in_array($home_page_variant_number,['02','03','04']))
                            <div class="form-group">
                                <label for="home_page_{{$home_page_variant_number}}_key_feature_number">{{__('Display Number of Features')}}</label>
                                <input type="number" name="home_page_{{$home_page_variant_number}}_key_feature_number" value="{{get_static_option('home_page_'.$home_page_variant_number.'_key_feature_number')}}" class="form-control" id="home_page_{{$home_page_variant_number}}_key_feature_number">
                            </div>
                            @endif
                            @if($home_page_variant_number == '01')
                            <div class="form-group">
                                <label for="image">{{__('Background Image')}}</label>
                                <x-image :id="'home_page_keyfeatures_section_'.$home_page_variant_number.'_bg_img'" :name="'home_page_keyfeatures_section_'.$home_page_variant_number.'_bg_img'" :value="'home_page_keyfeatures_section_'.$home_page_variant_number.'_bg_img'"/>
                                <small class="form-text text-danger">{{__('* jpg,jpeg,png')}}</small>
                            </div>
                            @endif
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
        });
        })(jQuery);
    </script>
@endsection

