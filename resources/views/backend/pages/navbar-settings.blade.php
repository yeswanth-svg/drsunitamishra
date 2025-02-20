@extends('backend.admin-master')
@section('site-title')
    {{__('Navbar Settings')}}
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
                        <h4 class="header-title">{{__('Navbar Settings')}}</h4>
                        <form action="{{route('admin.navbar.settings')}}" method="post" enctype="multipart/form-data">@csrf
                            <x-lang-nav/>
                            <div class="form-group margin-top-30">
                             <label for="navbar_button ">{{__('Button Visiblity')}}</label>
                            <label class="switch">
                                <input type="checkbox" name="navbar_button" @if(!empty(get_static_option('navbar_button'))) checked @endif id="navbar_button">
                                <span class="slider"></span>
                            </label>
                            </div>
                            <div class="tab-content " id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        @if($home_page_variant_number == '03')
                                            <div class="form-group">
                                                <label for="navbar_button_title_{{$lang->slug}}">{{__('Title')}}</label>
                                                <input type="title" name="navbar_button_title_{{$lang->slug}}" class="form-control" value="{{get_static_option('navbar_button_title_'.$lang->slug)}}" id="navbar_button_title_{{$lang->slug}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="navbar_button_details_{{$lang->slug}}">{{__('Details')}}</label>
                                                <input type="details" name="navbar_button_details_{{$lang->slug}}" class="form-control" value="{{get_static_option('navbar_button_details_'.$lang->slug)}}" id="navbar_button_details_{{$lang->slug}}">
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for="navbar_button_text_{{$lang->slug}}">{{__('Button Text')}}</label>
                                                <input type="text" name="navbar_button_text_{{$lang->slug}}" class="form-control" value="{{get_static_option('navbar_button_text_'.$lang->slug)}}" id="navbar_button_text_{{$lang->slug}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="navbar_button_url_{{$lang->slug}}">{{__('Button URL')}}</label>
                                                <input type="text" name="navbar_button_url_{{$lang->slug}}" class="form-control" value="{{get_static_option('navbar_button_url_'.$lang->slug)}}" id="navbar_button_url_{{$lang->slug}}">
                                            </div>
                                        @endif
                                        
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="icon" class="d-block">{{__('Shopping Cart Icon')}}</label>
                                <div class="btn-group icon">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="{{get_static_option('shopping_cart_icon')}}"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="{{get_static_option('shopping_cart_icon')}}" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">{{__("Toggle Dropdown")}}</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon" value="{{get_static_option('shopping_cart_icon')}}" name="shopping_cart_icon">
                            </div>
                            @if($home_page_variant_number == '03')
                                <div class="form-group">
                                    <label for="icon" class="d-block">{{__('Title Icon')}}</label>
                                    <div class="btn-group icon">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="{{get_static_option('navbar_title_icon')}}"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                data-selected="{{get_static_option('navbar_title_icon')}}" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">{{__("Toggle Dropdown")}}</span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control"  id="icon" value="{{get_static_option('navbar_title_icon')}}" name="navbar_title_icon">
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="icon" class="d-block">{{__('Button Icon')}}</label>
                                    <div class="btn-group icon">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="{{get_static_option('navbar_button_icon')}}"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                data-selected="{{get_static_option('navbar_button_icon')}}" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">{{__("Toggle Dropdown")}}</span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control"  id="icon" value="{{get_static_option('navbar_button_icon')}}" name="navbar_button_icon">
                                </div>
                            @endif
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
(function ($){
"use strict";
    $(document).ready(function () {
     <x-icon-picker/>
     <x-btn.update/>
});
})(jQuery)
</script>

@endsection

