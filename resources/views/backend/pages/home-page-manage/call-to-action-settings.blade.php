@extends('backend.admin-master')
@section('site-title')
    {{__('Call to Action Settings')}}
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
                        <h4 class="header-title">{{__('Call to Action Settings')}}</h4>
                        <form action="{{route('admin.home.call.to.action')}}" method="post" enctype="multipart/form-data">@csrf
                           <x-lang-nav/>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_call_to_action_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" name="home_page_call_to_action_section_{{$lang->slug}}_title" class="form-control" placeholder="{{__('Title')}}" value="{{get_static_option('home_page_call_to_action_section_'.$lang->slug.'_title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_call_to_action_section_{{$lang->slug}}_support_title">{{__('Support Title')}}</label>
                                        <input type="text" name="home_page_call_to_action_section_{{$lang->slug}}_support_title" class="form-control" placeholder="{{__('Title')}}" value="{{get_static_option('home_page_call_to_action_section_'.$lang->slug.'_support_title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_call_to_action_section_{{$lang->slug}}_support_details">{{__('Support URL')}}</label>
                                        <input type="text" name="home_page_call_to_action_section_{{$lang->slug}}_support_details" class="form-control" placeholder="{{__('Title')}}" value="{{get_static_option('home_page_call_to_action_section_'.$lang->slug.'_support_details')}}">
                                    </div>
                                </div>
                               @endforeach
                            </div>
                            <x-add-icon :name="'home_page_call_to_action_section_icon'" :id="'home_page_call_to_action_section_icon'" :title="__('Icon')" :value="'home_page_call_to_action_section_icon'"/>
                            <div class="form-group">
                                <label for="home_page_call_to_action_section_bg">{{__('Background Image')}}</label>
                                <x-image :id="'home_page_call_to_action_section_bg'" :name="'home_page_call_to_action_section_bg'" :value="'home_page_call_to_action_section_bg'"/>
                                <small class="form-text text-muted">{{__('1920 x 200 pixels (recommended)')}}</small>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
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
        <x-icon-picker/>
        <x-btn.update/>
    });
    })(jQuery);
</script>
@endsection
