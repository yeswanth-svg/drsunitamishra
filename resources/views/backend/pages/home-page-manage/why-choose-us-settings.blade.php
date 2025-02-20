@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endsection
@section('site-title')
    {{__('Why Choose Us Section')}}
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
                        <h4 class="header-title">{{__('Why Choose Us Area Settings')}}</h4>
                        <form action="{{route('admin.home.why.choose.us')}}" method="post" enctype="multipart/form-data">
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
                                                    <label for="home_page_why_choose_us_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                                    <input type="text" name="home_page_why_choose_us_section_{{$lang->slug}}_title" value="{{get_static_option('home_page_why_choose_us_section_'.$lang->slug.'_title')}}" class="form-control" id="home_page_{{$lang->slug}}_why_choose_us_section_title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="home_page_why_choose_us_section_{{$lang->slug}}_description">{{__('Description')}}</label>
                                                    <textarea name="home_page_why_choose_us_section_{{$lang->slug}}_description" class="form-control" >{{get_static_option('home_page_why_choose_us_section_'.$lang->slug.'_description')}}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label for="price_plan">{{__('Select Services to Display')}}</label>
                                        <select name="why_choose_us_selected_services[]" multiple class="form-control nice-select wide">
                                            @php
                                                $selected_service = !empty(get_static_option('why_choose_us_selected_services')) ? unserialize(get_static_option('why_choose_us_selected_services')) : [];
                                            @endphp
                                            @foreach($all_services as $data)
                                                <option value="{{$data->id}}" @if(is_array($selected_service) && in_array($data->id,$selected_service)) selected @endif>{{optional($data->lang)->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if(in_array(get_static_option('why_choose_us_home_'.$home_page_variant_number.'_variant'),['03','04']))
                                <div class="bg-image-check col-lg-4 col-md-6 mt-4">
                                    <div class="form-group">
                                        <label for="home_page_{{$home_page_variant_number}}_why_choose_us_bg">{{__('Background Image')}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $image = get_attachment_image_by_id(get_static_option('home_page_'.$home_page_variant_number.'_why_choose_us_bg'),null,true);
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
                                            <input type="hidden" id="home_page_{{$home_page_variant_number}}_why_choose_us_bg" name="home_page_{{$home_page_variant_number}}_why_choose_us_bg" value="{{get_static_option('home_page_'.$home_page_variant_number.'_why_choose_us_bg')}}">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                {{__($image_btn_label)}}
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png.')}}</small>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control"  id="why_choose_us_variant" value="{{get_static_option('why_choose_us_home_'.$home_page_variant_number.'_variant')}}" name="why_choose_us_home_{{ $home_page_variant_number }}_variant">
                            </div>
                            <label for="why_choose_us_variant">{{__('Choose Why Choose Us Variant :')}}</label>
                            <div class="row">
                                @for($i = 1; $i < 5; $i++)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="img-select selected">
                                            <div class="img-wrap">
                                                <img src="{{asset('assets/frontend/why-choose-us-variant/why-choose-us-0'.$i.'.png')}}" data-why_choose_us_id="0{{$i}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
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
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function () {
                <x-btn.update/>
                if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
                }
                var imgSelect = $('.img-select');
                var id = $('#why_choose_us_variant').val();
                imgSelect.removeClass('selected');
                $('img[data-why_choose_us_id="'+id+'"]').parent().parent().addClass('selected');
                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#why_choose_us_variant').val($(this).data('why_choose_us_id'));
                })
            })
        })(jQuery);
    </script>
@endsection
