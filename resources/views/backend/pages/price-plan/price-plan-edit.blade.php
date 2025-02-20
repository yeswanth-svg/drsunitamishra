@extends('backend.admin-master')
@section('style')
<x-media.css/>
@endsection
@section('site-title')
    {{__('Edit Price Plan')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Edit Price Plan')}}  </h4>
                            <div class="header-title">
                                <a href="{{ route('admin.price.plan') }}" class="btn btn-primary mt-4 pr-4 pl-4">{{__('All Price Plans')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.price.plan.update',$price_plan->id)}}" method="post" enctype="multipart/form-data">@csrf
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
                                        @foreach ($price_plan->lang_all->where('lang',$lang->slug) as $item)
                                            <div class="form-group">
                                                <label for="title">{{__('Title')}}</label>
                                                <input type="text" class="form-control" name="title[{{$lang->slug}}]" value="{{$item->title}}" placeholder="{{__('Title')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="type">{{__('Type')}}</label>
                                                <input type="text" class="form-control" name="type[{{$lang->slug}}]" value="{{$item->type}}" placeholder="{{__('Type')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="features">{{__('Features')}}</label>
                                                <textarea name="features[{{$lang->slug}}]" class="form-control" rows="5" id="features">{{$item->features}}</textarea>
                                                <small class="form-text text-muted">{{__('Separate feature by entering a new line.')}}</small> 
                                            </div>
                                            <div class="form-group">
                                                <label for="btn_text">{{__('Button Text')}}</label>
                                                <input type="text" class="form-control" name="btn_text[{{$lang->slug}}]" value="{{$item->btn_text}}" placeholder="{{__('Button Text')}}">
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="btn_url">{{__('Button URL')}}</label>
                                <input type="text" class="form-control"  id="btn_url" value="{{$price_plan->btn_url}}"  name="btn_url" placeholder="{{__('Button URL')}}">
                                <small class="form-text text-danger">{{__('Please leave it blank if you want to use the default package ordering system')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('Price')}}</label>
                                <input type="number" class="form-control"  id="price" value="{{$price_plan->price}}"  name="price" placeholder="{{__('Price')}}">
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $image = get_attachment_image_by_id($price_plan->image,null,true);
                                            $image_btn_label = 'Upload Image';
                                        @endphp
                                        @if (!empty($image))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$image['img_url']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php  $image_btn_label = 'Change Image'; @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" id="image" name="image" value="{{$price_plan->image}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($image_btn_label)}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{__('360 x 160 pixels (recommended)')}}</small>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update')}}</button>
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