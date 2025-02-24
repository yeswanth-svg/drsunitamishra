@extends('backend.admin-master')
@section('style')
<link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
<x-summernote.css/>
<x-media.css/>
@endsection
@section('site-title')
    {{__('Edit Blog Post')}}
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
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Edit Blog Post')}}  </h4>
                            <div class="header-title">
                                <a href="{{ route('admin.blog') }}" class="btn btn-primary mt-4 pr-4 pl-4">{{__('All Blog Post')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.blog.update',$blog_post->id)}}" method="post" enctype="multipart/form-data"> @csrf
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($all_languages as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif"  data-toggle="tab" href="#slider_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($loop->first) show active @endif" id="slider_tab_{{$lang->slug}}" role="tabpanel" >
                                    @foreach ($blog_post->blog->where('lang',$lang->slug) as $data)
                                    <div class="form-group">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" name="title[{{$lang->slug}}]" value="{{$data->title}}" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Content')}}</label>
                                        <input type="hidden" name="blog_content[{{$lang->slug}}]" value="{{ $data->content }}">
                                        <div class="summernote" data-content="{{ $data->content }}"></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="author">{{__('Author')}}</label>
                                            <input type="text" class="form-control" name="author[{{$lang->slug}}]" value="{{$data->author}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="slug">{{__('Slug')}}</label>
                                            <input type="text" class="form-control" name="slug[{{$lang->slug}}]" value="{{$data->slug}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="title">{{__('Blog Tags')}}</label>
                                            <input type="text" class="form-control" name="tags[{{$lang->slug}}]" data-role="tagsinput" value="{{$data->tags}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="meta_tags">{{__('Meta Tags')}}</label>
                                            <input type="text" class="form-control" name="meta_tags[{{$lang->slug}}]" data-role="tagsinput" value="{{$data->meta_tags}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="meta_title">{{__('Meta Title')}}</label>
                                            <input type="text" class="form-control" name="meta_title[{{$lang->slug}}]" value="{{$data->meta_title}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="og_meta_title">{{__('Og Meta Title')}}</label>
                                            <input type="text" class="form-control" name="og_meta_title[{{$lang->slug}}]" value="{{$data->og_meta_title}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="meta_description">{{__('Meta Description')}}</label>
                                            <textarea type="text" class="form-control" name="meta_description[{{$lang->slug}}]" rows="5" cols="10">{{$data->meta_description}}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="og_meta_description">{{__('Og Meta Description')}}</label>
                                            <textarea type="text" class="form-control" name="og_meta_description[{{$lang->slug}}]" rows="5" cols="10">{{$data->og_meta_description}} </textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="image">{{__('Blog Image')}}</label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    @php
                                                        $image = get_attachment_image_by_id($data->image,null,true);
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
                                                <input type="hidden" id="image" name="image[{{$lang->slug}}]" value="{{$data->image}}">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                    {{__($image_btn_label)}}
                                                </button>
                                            </div>
                                            <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="og_meta_image">{{__('Og Meta Image')}}</label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    @php
                                                        $image = get_attachment_image_by_id($data->og_meta_image,null,true);
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
                                                <input type="hidden" id="og_meta_image" name="og_meta_image[{{$lang->slug}}]" value="{{$data->og_meta_image}}">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                    {{__($image_btn_label)}}
                                                </button>
                                            </div>
                                            <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                        </div>
                                        
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                                <div class="row">
                                    <div class="form-group  col-md-6">
                                        <label for="category">{{__('Category')}}</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">{{__("Select Category")}}</option>
                                            @foreach($all_category as $category)
                                                <option @if($category->id == $blog_post->category_id) selected @endif  value="{{$category->id}}">{{purify_html(optional($category->lang)->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status">{{__('Status')}}</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="draft" {{($blog_post->status == 'draft' )? 'selected' : ''}}>{{__("Draft")}}</option>
                                            <option value="publish" {{($blog_post->status  == 'publish')? 'selected' : ''}}>{{__("Publish")}}</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Post')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('script')
<x-summernote.js/>
<x-media.js/>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script>
       (function ($){
            "use strict";
        $(document).ready(function () {
            <x-btn.update/>
        });
    })(jQuery)
    </script>
@endsection
