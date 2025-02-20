@extends('backend.admin-master')
@section('site-title')
    {{__('Contact Area')}}
@endsection
@section('style')
    @include('backend.partials.dropzone.style-enqueue')
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
                        <h4 class="header-title">{{__('Contact Area Settings')}}</h4>
                        <form action="{{route('admin.homeone.contact')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('backend.partials.languages-nav')
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_01_contact_title_{{$lang->slug}}">{{__('Title')}}</label>
                                        <input type="text" name="home_page_01_contact_title_{{$lang->slug}}" class="form-control"
                                               value="{{get_static_option('home_page_01_contact_title_'.$lang->slug)}}"
                                               id="home_page_01_contact_title_{{$lang->slug}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_contact_description_{{$lang->slug}}">{{__('Description')}}</label>
                                        <textarea name="home_page_01_contact_description_{{$lang->slug}}" class="form-control"
                                                  id="home_page_01_contact_description_{{$lang->slug}}" cols="30"
                                                  rows="10">{{get_static_option('home_page_01_contact_description_'.$lang->slug)}}</textarea>
                                    </div>
                                </div>
                               @endforeach
                            </div>
                            <div class="form-group">
                                <label for="site_favicon">{{__('Background Image')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $home_page_01_contact_bg_image = get_attachment_image_by_id(get_static_option('home_page_01_contact_bg_image'),null,true);
                                            $home_page_01_contact_bg_image_btn_label = __('Upload Background Image');
                                        @endphp
                                        @if (!empty($home_page_01_contact_bg_image))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$home_page_01_contact_bg_image['img_url']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php  $home_page_01_contact_bg_image_btn_label = __('Change Image'); @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" id="home_page_01_contact_bg_image" name="home_page_01_contact_bg_image" value="{{get_static_option('home_page_01_contact_bg_image')}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($home_page_01_contact_bg_image_btn_label)}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
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


