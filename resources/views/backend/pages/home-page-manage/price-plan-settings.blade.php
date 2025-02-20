@extends('backend.admin-master')
@section('site-title')
    {{__('Price Plan Area Settings')}}
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
                        <h4 class="header-title">{{__('Price Plan Area Settings')}}</h4>
                        <form action="{{route('admin.home.price.plan')}}" method="post" enctype="multipart/form-data"> @csrf
                            <x-lang-nav/>
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_price_plan_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" name="home_page_price_plan_section_{{$lang->slug}}_title" value="{{get_static_option('home_page_price_plan_section_'.$lang->slug.'_title')}}" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_price_plan_section_{{$lang->slug}}_description">{{__('Description')}}</label>
                                        <textarea type="text" class="form-control" name="home_page_price_plan_section_{{$lang->slug}}_description" value="{{get_static_option('home_page_price_plan_section_'.$lang->slug.'_description')}}" rows="3" cols="3">{{get_static_option('home_page_price_plan_section_'.$lang->slug.'_description')}}</textarea>
                                    </div>
                                </div>
                               @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_price_plan_section_display_item">{{__('Number of Item Display')}}</label>
                                <input type="number" class="form-control" name="home_page_price_plan_section_display_item" value="{{get_static_option('home_page_price_plan_section_display_item')}}" placeholder="{{__('Number of Item Display')}}">
                            </div>
                            <button type="submit" id="update" class="btn btn-primary pr-4 pl-4">{{__('Update Settings')}}</button>
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
