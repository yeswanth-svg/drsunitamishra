@extends('backend.admin-master')
@section('style')
<x-summernote.css/>
<link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
<x-media.css/>
@endsection
@section('site-title')
    {{__('New Blog Post')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-msg.success/>
               <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Add New Blog Post')}}  </h4>
                            <div class="header-title">
                                <a href="{{ route('admin.blog') }}" class="btn btn-primary mt-4 pr-4 pl-4">{{__('All Blog Post')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.blog.new')}}" method="post" enctype="multipart/form-data">@csrf
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
                                    <div class="form-group">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" name="title[{{$lang->slug}}]" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Content')}}</label>
                                        <input type="hidden" name="blog_content[{{$lang->slug}}]" >
                                        <div class="summernote"></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="author">{{__('Author')}}</label>
                                            <input type="text" class="form-control" name="author[{{$lang->slug}}]">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="slug">{{__('Slug')}}</label>
                                            <input type="text" class="form-control" name="slug[{{$lang->slug}}]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="title">{{__('Blog Tags')}}</label>
                                            <input type="text" class="form-control" name="tags[{{$lang->slug}}]" data-role="tagsinput">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="meta_tags">{{__('Meta Tags')}}</label>
                                            <input type="text" class="form-control" name="meta_tags[{{$lang->slug}}]" data-role="tagsinput">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="meta_title">{{__('Meta Title')}}</label>
                                            <input type="text" class="form-control" name="meta_title[{{$lang->slug}}]">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="og_meta_title">{{__('Og Meta Title')}}</label>
                                            <input type="text" class="form-control" name="og_meta_title[{{$lang->slug}}]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="meta_description">{{__('Meta Description')}}</label>
                                            <textarea type="text" class="form-control" name="meta_description[{{$lang->slug}}]" rows="5" cols="10"> </textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="og_meta_description">{{__('Og Meta Description')}}</label>
                                            <textarea type="text" class="form-control" name="og_meta_description[{{$lang->slug}}]" rows="5" cols="10"> </textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="image">{{__('Blog Image')}}</label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap"></div>
                                                <input type="hidden" name="image[{{$lang->slug}}]">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                    {{__('Upload Image')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="og_meta_image">{{__('OG Meta Image')}}</label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap"></div>
                                                <input type="hidden" name="og_meta_image[{{$lang->slug}}]">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                    {{__('Upload Image')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="row">
                                    <div id="category_list" class="form-group col-md-6">
                                        <label for="category">{{__('Category')}}</label>
                                        <select name="category_id" class="form-control" >
                                            <option value="">{{__("Select Category")}}</option>
                                            @foreach($all_category as $category)
                                                <option value="{{$category->id}}">{{purify_html(optional($category->lang)->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status">{{__('Status')}}</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="draft">{{__("Draft")}}</option>
                                            <option value="publish">{{__("Publish")}}</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" id="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Post')}}</button>
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
<script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
<x-summernote.js/>
<x-media.js/>
    <script>
   (function ($){
        "use strict";
        $(document).ready(function () {
            <x-btn.submit/>
        });
    })(jQuery)
    </script>
@endsection
