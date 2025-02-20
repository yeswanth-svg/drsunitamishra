@extends('backend.admin-master')
@section('site-title')
    {{__('Latest Blog Settings')}}
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
                        <h4 class="header-title">{{__('Latest Blog Area Settings')}}</h4>
                        <form action="{{route('admin.home.blog.latest')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('backend.partials.languages-nav')
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_latest_blog_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" name="home_page_latest_blog_section_{{$lang->slug}}_title" value="{{get_static_option('home_page_latest_blog_section_'.$lang->slug.'_title')}}" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_latest_blog_section_{{$lang->slug}}_subtitle">{{__('Sub Title')}}</label>
                                        <input type="text" class="form-control" name="home_page_latest_blog_section_{{$lang->slug}}_subtitle" value="{{get_static_option('home_page_latest_blog_section_'.$lang->slug.'_subtitle')}}" placeholder="{{__('Sub Title')}}">
                                    </div>
                                </div>
                               @endforeach
                               <div class="form-group">
                                    <label for="home_page_latest_blog_section_display_item">{{__('Number of Item Display')}}</label>
                                    <input type="number" class="form-control" name="home_page_latest_blog_section_display_item" value="{{get_static_option('home_page_latest_blog_section_display_item')}}" placeholder="{{__('Number of Item Display')}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
