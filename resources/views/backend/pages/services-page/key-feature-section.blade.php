@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Key Feature Section')}}
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
                        <h4 class="header-title">{{__('Key Feature Section Settings')}}</h4>
                        <form action="{{route('admin.services.key.feature')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="row">
                                <div class="col-lg-8 col-md-6">
                                    <div class="tab-content margin-top-30" id="nav-tabContent">
                                        @foreach($all_languages as $key => $lang)
                                            <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <div class="form-group">
                                                    <label for="services_page_{{$lang}}_key_feature_section_title">{{__('Title')}}</label>
                                                    <input type="text" name="services_page_{{$lang->slug}}_key_feature_section_title" value="{{get_static_option('services_page_'.$lang->slug.'_key_feature_section_title')}}" class="form-control" id="services_page_{{$lang->slug}}_key_feature_section_title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="services_page_{{$lang}}_key_feature_section_subtitle">{{__('Sub Title')}}</label>
                                                    <input type="text" name="services_page_{{$lang->slug}}_key_feature_section_subtitle" value="{{get_static_option('services_page_'.$lang->slug.'_key_feature_section_subtitle')}}" class="form-control" id="services_page_{{$lang->slug}}_key_feature_section_subtitle">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="services_page_key_feature_item">{{__('Key Feature Items')}}</label>
                                        <input type="number" name="services_page_key_feature_item" value="{{get_static_option('services_page_key_feature_item')}}" class="form-control" id="services_page_key_feature_item">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mt-4">
                                    <div class="form-group">
                                        <label for="services_page_key_feature_bg">{{__('Background Image')}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $image = get_attachment_image_by_id(get_static_option('services_page_key_feature_bg'),null,true);
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
                                            <input type="hidden" id="services_page_key_feature_bg" name="services_page_key_feature_bg" value="{{get_static_option('services_page_key_feature_bg')}}">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                {{__($image_btn_label)}}
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png.')}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control"  id="services_page_key_feature_variant" value="{{get_static_option('services_page_key_feature_variant')}}" name="services_page_key_feature_variant">
                            </div>
                            <label for="services_page_key_feature_item">{{__('Choose Key Feature Variant :')}}</label>
                            <div class="row">
                                @for($i = 1; $i < 7; $i++)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="img-select selected">
                                            <div class="img-wrap">
                                                <img src="{{asset('assets/frontend/key-feature-variant/keyfeature-0'.$i.'.png')}}" data-keyfeature_id="0{{$i}}" alt="">
                                            </div>
                                        </div>
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
    <script>
        (function($){
            "use strict";
            $(document).ready(function () {
                var imgSelect = $('.img-select');
                var id = $('#services_page_key_feature_variant').val();
                imgSelect.removeClass('selected');
                $('img[data-keyfeature_id="'+id+'"]').parent().parent().addClass('selected');
                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#services_page_key_feature_variant').val($(this).data('keyfeature_id'));
                })
            })
        })(jQuery);
    </script>
@endsection
