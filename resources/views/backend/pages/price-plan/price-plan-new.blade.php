@extends('backend.admin-master')
@section('style')
<x-media.css/>
@endsection
@section('site-title')
    {{__('Price Plan New')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Add New Price Plan')}}  </h4>
                            <div class="header-title">
                                <a href="{{ route('admin.price.plan') }}" class="btn btn-primary mt-4 pr-4 pl-4">{{__('All Price Plan')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.price.plan.new')}}" method="post" enctype="multipart/form-data">@csrf
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($all_languages as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif"  data-toggle="tab" href="#slider_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-40" >
                                @foreach($all_languages as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="slider_tab_{{$lang->slug}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="title">{{__('Title')}}</label>
                                            <input type="text" class="form-control" name="title[{{$lang->slug}}]" placeholder="{{__('Title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="type">{{__('Type')}}</label>
                                            <input type="text" class="form-control" name="type[{{$lang->slug}}]" placeholder="{{__('Type')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="features">{{__('Features')}}</label>
                                            <textarea name="features[{{$lang->slug}}]" class="form-control" rows="5" id="features"></textarea>
                                            <small class="form-text text-muted">{{__('Separate feature by entering a new line.')}}</small> 
                                        </div>
                                        <div class="form-group">
                                            <label for="btn_text">{{__('Button Text')}}</label>
                                            <input type="text" class="form-control" name="btn_text[{{$lang->slug}}]" placeholder="{{__('Button Text')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="btn_url">{{__('Button URL')}}</label>
                                <input type="text" class="form-control"  id="btn_url"  name="btn_url" placeholder="{{__('Button URL')}}">
                                <small class="form-text text-danger">{{__('Please leave it blank if you want to use the default package ordering system')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('Price')}}</label>
                                <input type="number" class="form-control"  id="price"  name="price" placeholder="{{__('Price')}}">
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <x-image :id="'image'" :name="'image'" :value="'image'"/>
                                <small class="form-text text-muted">{{__('360 x 160 pixels (recommended)')}}</small>
                            </div>
                            <button type="submit" id="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Submit')}}</button>
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
        <x-btn.submit/>
    });
    })(jQuery);
    </script>
@endsection

