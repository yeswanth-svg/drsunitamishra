@extends('backend.admin-master')
@section('style')
    <x-summernote.css/>
    <x-media.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endsection
@section('site-title')
    {{__('Services')}}
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
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('Add New Service')}}</h4>
                            <a href="{{route('admin.services')}}" class="btn btn-info">{{__('All Services')}}</a>
                        </div>
                        <form action="{{route('admin.services')}}" method="post" enctype="multipart/form-data">@csrf
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
                                            <label>{{__('Description')}}</label>
                                            <input type="hidden" name="description[{{$lang->slug}}]">
                                            <div class="summernote"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="excerpt">{{__('Excerpt')}}</label>
                                            <textarea name="excerpt[{{$lang->slug}}]" cols="30" rows="5" class="form-control"></textarea>
                                            <small class="info-text">{{__('it will show service item shortdetails.')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">{{__('Slug')}}</label>
                                            <input type="text" class="form-control" name="slug[{{$lang->slug}}]" placeholder="{{__('Slug')}}">
                                        </div>    
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="meta_title">{{__('Meta Title')}}</label>
                                                <input type="text" name="meta_title[{{$lang->slug}}]" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="og_meta_title">{{__('OG Meta Title')}}</label>
                                                <input type="text" name="og_meta_title[{{$lang->slug}}]" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="meta_description">{{__('Meta Description')}}</label>
                                                <textarea name="meta_description[{{$lang->slug}}]" class="form-control" rows="5" id="meta_description"></textarea>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="og_meta_description">{{__('OG Meta Description')}}</label>
                                                <textarea name="og_meta_description[{{$lang->slug}}]" class="form-control" rows="5" id="og_meta_description"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="meta_tags">{{__('Meta Tags')}}</label>
                                                <input type="text" name="meta_tags[{{$lang->slug}}]" class="form-control" data-role="tagsinput"
                                                       id="meta_tags">
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
                            </div>
                            <div class="form-group">
                                <label for="category">{{__('Category')}}</label>
                                <select name="categories_id" class="form-control" id="category">
                                    <option value="">{{__("Select Category")}}</option>
                                    @foreach($service_category as $category)
                                            <option value="{{$category->id}}">{{optional($category->lang)->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_icon_type">{{__('Icon Type')}}</label>
                                <select name="icon_type" class="form-control" id="edit_icon_type">
                                    <option value="icon">{{__("Font Icon")}}</option>
                                    <option value="image">{{__("Image Icon")}}</option>
                                </select>
                            </div>
                            <x-add-icon :name="'icon'" :id="'icon'" :title="__('Icon')"/>
                            <div class="form-group">
                                <label for="img_icon">{{__('Image Icon')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap"></div>
                                    <input type="hidden" id="img_icon" name="img_icon">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__('Upload Image Icon')}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{__('60 x 60 pixels (recommended)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="price_plan">{{__('Price Plans')}}</label>
                                <select name="price_plan[]" multiple class="form-control nice-select wide">
                                    @foreach($price_plans as $data)
                                        <option value="{{$data->id}}">{{purify_html(optional($data->lang)->title)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sr_order">{{__('Order')}}</label>
                                <input type="number" class="form-control"  value="{{old('sr_order')}}"  name="sr_order" placeholder="{{__('eg: 1')}}">
                                <span class="info-text">{{__('if you set order for it, all service will show in frontend as a per this order')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <x-image :id="'image'" :name="'image'" :value="'image'"/>
                                <small class="form-text text-muted">{{__('1920 x 1280 pixels (recommended)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="publish">{{__('Publish')}}</option>
                                    <option value="draft">{{__('Draft')}}</option>
                                </select>
                            </div>
                            <button type="submit" id="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add Service')}}</button>
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
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        (function ($){
            "use strict";    
        $(document).ready(function () {
            <x-btn.submit/>
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
    <x-media.js/>
@endsection
