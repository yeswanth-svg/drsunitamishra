@extends('backend.admin-master')
@section('style')
<x-summernote.css/>
<x-media.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endsection
@section('site-title')
    {{__('Edit Services')}}
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
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('Edit Service')}}</h4>
                            <a href="{{route('admin.services')}}" class="btn btn-info">{{__('All Services')}}</a>
                        </div>
                        <form action="{{route('admin.services.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$service->id}}">
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
                                        @foreach ($service->lang_all->where('lang',$lang->slug) as $item)
                                            <div class="form-group">
                                                <label for="title">{{__('Title')}}</label>
                                                <input type="text" class="form-control" name="title[{{$lang->slug}}]" value="{{$item->title}}" placeholder="{{__('Title')}}">
                                            </div>
                                            <div class="form-group">
                                                <label>{{__('Description')}}</label>
                                                <input type="hidden" name="description[{{$lang->slug}}]" value="{{$item->description}}">
                                                <div class="summernote" data-content="{{ $item->description }}"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="excerpt">{{__('Excerpt')}}</label>
                                                <textarea name="excerpt[{{$lang->slug}}]" cols="30" rows="5" class="form-control">{{$item->excerpt}}</textarea>
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
                            <div class="form-group">
                                <label for="category">{{__('Category')}}</label>
                                <select name="categories_id" id="category" class="form-control">
                                    <option value="">{{__('Select Category')}}</option>
                                    @foreach($service_category as $data)
                                        <option @if($service->categories_id == $data->id) selected @endif value="{{$data->id}}">{{purify_html(optional($data->lang)->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_icon_type">{{__('Icon Type')}}</label>
                                <select name="icon_type" class="form-control" id="edit_icon_type">
                                    <option @if($service->icon_type == 'icon') selected @endif value="icon">{{__("Font Icon")}}</option>
                                    <option @if($service->icon_type == 'image') selected @endif value="image">{{__("Image Icon")}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="d-block icon-view">{{__('Icon')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-info btn-lg iconpicker-component">
                                        <i class="{{$service->icon}}"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-info btn-lg dropdown-toggle"
                                            data-selected="{{$service->icon}}" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">{{__('Toggle Dropdown')}}</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon" value="{{$service->icon}}" name="icon">
                            </div>
                            <div class="form-group">
                                <label for="img_icon">{{__('Image Icon')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $service_section_img = get_attachment_image_by_id($service->img_icon,null,true);
                                            $image_btn_label = __('Upload Image Icon');
                                        @endphp
                                        @if (!empty($service_section_img))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$service_section_img['img_url']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                            $image_btn_label = __('Update Image Icon');
                                            @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" id="img_icon" name="img_icon" value="{{$service->img_icon}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{$image_btn_label}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{__('60 x 60 pixels (recommended)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="price_plan">{{__('Price Plans')}}</label>
                                <select name="price_plan[]" multiple class="form-control nice-select wide">
                                    @php
                                        $select_plan = !empty($service->price_plan) ? unserialize($service->price_plan) : [];
                                    @endphp
                                    @foreach($price_plans as $data)
                                        <option value="{{$data->id}}" @if(is_array($select_plan) && in_array($data->id,$select_plan)) selected @endif>{{purify_html(optional($data->lang)->title)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sr_order">{{__('Order')}}</label>
                                <input type="number" class="form-control"  id="sr_order"  name="sr_order" value="{{$service->sr_order}}">
                                <span class="info-text">{{__('if you set order for it, all service will show in frontend as a per this order')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $service_section_img = get_attachment_image_by_id($service->image,null,true);
                                            $image_btn_label = __('Upload Image');
                                        @endphp
                                        @if (!empty($service_section_img))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$service_section_img['img_url']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $image_btn_label = __('Update Image');
                                            @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" name="image" value="{{$service->image}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Service Image')}}" data-modaltitle="{{__('Upload Service Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{$image_btn_label}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{__('1920 x 1280 pixels (recommended)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" id="status" class="form-control">
                                    <option @if($service->status == 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                                    <option @if($service->status == 'draft') selected @endif value="draft">{{__('Draft')}}</option>
                                </select>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Service')}}</button>
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
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        (function ($){
            "use strict";        
        $(document).ready(function () {
            <x-btn.update/>
            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }
            $(document).on('change','select[name="icon_type"]',function (e){
                e.preventDefault();
                var iconType = $(this).val();
                iconTypeFieldVal(iconType);
            });
            defaultIconType();

            function defaultIconType(){
                var iconType = $('select[name="icon_type"]').val();
                iconTypeFieldVal(iconType);
            }

            function iconTypeFieldVal(iconType){
                if (iconType == 'icon'){
                    $('input[name="img_icon"]').parent().parent().hide();
                    $('input[name="icon"]').parent().show();
                }else if(iconType == 'image'){
                    $('input[name="icon"]').parent().hide();
                    $('input[name="img_icon"]').parent().parent().show();
                }
            }
            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

        });
    })(jQuery)
    </script>
@endsection
