@extends('backend.admin-master')
@section('style')
<link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
<link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
<x-media.css/>
@endsection
@section('site-title')
    {{__('Edit Page')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Edit Page')}}  </h4>
                            <div class="header-title">
                                <a href="{{ route('admin.page') }}" class="btn btn-primary mt-4 pr-4 pl-4">{{__('All Pages')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.page.update',$page_post->id)}}" method="post" enctype="multipart/form-data">@csrf
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
                                        @foreach ($page_post->lang_all->where('lang',$lang->slug) as $item)
                                            <div class="form-group">
                                                <label for="title">{{__('Title')}}</label>
                                                <input type="text" class="form-control" name="title[{{$lang->slug}}]" value="{{$item->title}}" placeholder="{{__('Title')}}">
                                            </div>
                                            <div class="form-group">
                                                <label>{{__('Content')}}</label>
                                                <input type="hidden" name="content[{{$lang->slug}}]" value="{{$item->content}}">
                                                <div class="summernote" data-content="{{ $item->content }}"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="slug">{{__('Slug')}}</label>
                                                <input type="text" class="form-control" name="slug[{{$lang->slug}}]" value="{{$item->slug}}" placeholder="{{__('Slug')}}">
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="meta_title">{{__('Meta Title')}}</label>
                                                    <input type="text" name="meta_title[{{$lang->slug}}]" value="{{$item->meta_title}}" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="og_meta_title">{{__('OG Meta Title')}}</label>
                                                    <input type="text" name="og_meta_title[{{$lang->slug}}]" value="{{$item->og_meta_title}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="meta_description">{{__('Meta Description')}}</label>
                                                    <textarea name="meta_description[{{$lang->slug}}]" class="form-control" rows="5" id="meta_description">{{$item->meta_description}}</textarea>
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="og_meta_description">{{__('OG Meta Description')}}</label>
                                                    <textarea name="og_meta_description[{{$lang->slug}}]" class="form-control" rows="5" id="og_meta_description">{{$item->og_meta_description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="meta_tags">{{__('Meta Tags')}}</label>
                                                    <input type="text" name="meta_tags[{{$lang->slug}}]" class="form-control" data-role="tagsinput"
                                                        id="meta_tags" value="{{$item->meta_tags}}" >
                                                </div>
                                                <div class="form-group col-md-6 col-lg-6">
                                                    <label for="og_meta_image[{{$lang->slug}}]">{{__('OG Meta Image')}}</label>
                                                    <div class="media-upload-btn-wrapper">
                                                        <div class="img-wrap">
                                                            @php
                                                                $image = get_attachment_image_by_id($item->og_meta_image,null,true);
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
                                                        <input type="hidden" id="og_meta_image[{{$lang->slug}}]" name="og_meta_image[{{$lang->slug}}]" value="{{$item->og_meta_image}}">
                                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                            {{__($image_btn_label)}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <x-fields.status :name="'status'" :title="__('Status')" :value="$page_post->status"/>
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
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-btn.update/>
            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if($('.summernote').length > 0){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }
        });
                
        })(jQuery);
    </script>
@endsection
