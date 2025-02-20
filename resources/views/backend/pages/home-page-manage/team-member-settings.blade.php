@extends('backend.admin-master')
@section('site-title')
    {{__('Team Member Area')}}
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
                        <h4 class="header-title">{{__('Team Member Area Settings')}}</h4>
                        <form action="{{route('admin.home.team.member')}}" method="post" enctype="multipart/form-data">@csrf
                            <x-lang-nav/>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="home_page_team_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                            <input type="text" name="home_page_team_section_{{$lang->slug}}_title" class="form-control" value="{{get_static_option('home_page_team_section_'.$lang->slug.'_title')}}" id="home_page_team_section_{{$lang->slug}}_title">
                                        </div>
                                    </div>
                               @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_team_section_item">{{__('Display Number of Items')}}</label>
                                <input type="number" name="home_page_team_section_item" value="{{get_static_option('home_page_team_section_item')}}" class="form-control" id="home_page_team_section_item">
                            </div>
                            @if($home_page_variant_number == '02')
                            <div class="form-group">
                                <label for="home_page_team_section_bg">{{__('Background Image')}}</label>
                                <x-image :id="'home_page_team_section_bg'" :name="'home_page_team_section_bg'" :value="'home_page_team_section_bg'"/>
                                <small class="form-text text-danger">{{__('* jpg,jpeg,png')}}</small>
                            </div>
                            @endif
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                            </div>
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
