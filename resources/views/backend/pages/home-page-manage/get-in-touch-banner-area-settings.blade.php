@extends('backend.admin-master')
@section('site-title')
    {{__('Get In Touch Area Settings')}}
@endsection
@section('style')
@include('backend.partials.dropzone.style-enqueue')
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Get In Touch Area Settings')}}</h4>
                        <form action="{{route('admin.home.get.in.touch.banner')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('backend.partials.languages-nav')
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_get_in_touch_banner_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" name="home_page_get_in_touch_banner_section_{{$lang->slug}}_title" class="form-control" placeholder="{{__('Title')}}" value="{{get_static_option('home_page_get_in_touch_banner_section_'.$lang->slug.'_title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_get_in_touch_banner_section_{{$lang->slug}}_phone">{{__('Phone No')}}</label>
                                        <input type="text" name="home_page_get_in_touch_banner_section_{{$lang->slug}}_phone" class="form-control" placeholder="{{__('Phone No')}}" value="{{get_static_option('home_page_get_in_touch_banner_section_'.$lang->slug.'_phone')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_get_in_touch_banner_section_{{$lang->slug}}_email">{{__('Email')}}</label>
                                        <input type="text" name="home_page_get_in_touch_banner_section_{{$lang->slug}}_email" class="form-control" placeholder="{{__('Email')}}" value="{{get_static_option('home_page_get_in_touch_banner_section_'.$lang->slug.'_email')}}">
                                    </div>
                                    
                                </div>
                               @endforeach
                            </div>
                            <div class="row">
                                @for($i=1 ; $i<4; $i++)
                                    <div class="form-group col-md-2">
                                        <label for="home_page_get_in_touch_banner_shape_{{$i}}">{{__('Section Background Texture')}}{{' '.$i}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $image = get_attachment_image_by_id(get_static_option('home_page_get_in_touch_banner_shape_'.$i),null,true);
                                                    $image_btn_label = __('Upload Image');
                                                @endphp
                                                @if (!empty($image))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="{{$image['img_url']}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php  $image_btn_label = __('Change Image'); @endphp
                                                @endif
                                            </div>
                                            <input type="hidden" id="home_page_get_in_touch_banner_shape_{{$i}}" name="home_page_get_in_touch_banner_shape_{{$i}}" value="{{get_static_option('home_page_get_in_touch_banner_shape_'.$i)}}">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                {{__($image_btn_label)}}
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png.')}}</small>
                                    </div>
                                @endfor
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
