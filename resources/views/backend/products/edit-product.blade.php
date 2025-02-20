@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Products')}}
@endsection
@section('style')
    <x-media.css/>
    <x-summernote.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-datepicker.min.css')}}">
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
                            <h4 class="header-title">{{__('Edit Products')}}</h4>
                            <a href="{{route('admin.products.all')}}" class="btn btn-info">{{__('All Products')}}</a>
                        </div>
                        <form action="{{route('admin.products.update')}}" method="post" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
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
                                        @foreach ($product->lang_all->where('lang',$lang->slug) as $data)
                                        <div class="form-group">
                                            <label for="title">{{__('Title')}}</label>
                                            <input type="text" class="form-control"   name="title[{{$lang->slug}}]" value="{{$data->title}}" placeholder="{{__('Title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">{{__('Slug')}}</label>
                                            <input type="text" class="form-control"  name="slug[{{$lang->slug}}]" value="{{$data->slug}}" placeholder="{{__('slug')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="badge">{{__('Badge')}}</label>
                                            <input type="text" class="form-control"  name="badge[{{$lang->slug}}]" value="{{$data->badge}}" placeholder="{{__('eg: New')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input type="hidden" name="description[{{$lang->slug}}]" value="{{$data->description}}">
                                            <div class="summernote" data-content="{{$data->description}}"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="short_description">{{__('Short Description')}}</label>
                                            <textarea name="short_description[{{$lang->slug}}]" id="short_description" class="form-control max-height-120" cols="30" rows="4" placeholder="{{__('Short Description')}}">{{$data->short_description}}</textarea>
                                        </div>
                                        <div class="form-group attributes-field">
                                            <label for="attributes">{{__('Attributes')}}</label>
                                            @php
                                                $att_title = unserialize($data->attributes_title,['class' => false]);
                                                $att_descr = unserialize($data->attributes_description,['class' => false]);
                                            @endphp
                                            @if(!empty($att_title))
                                            @foreach($att_title as $key => $att_title)
                                                <div class="attribute-field-wrapper" data-language="{{$lang->slug}}">
                                                   <input type="text" class="form-control"  id="attributes" name="attributes_title[{{$lang->slug}}][]" value="{{$att_title}}">
                                                   <textarea name="attributes_description[{{$lang->slug}}][]"  class="form-control" rows="5">{{purify_html($att_descr[$key]) ?? ''}}</textarea>
                                                  <div class="icon-wrapper">
                                                      <span class="add_attributes" data-lang="{{$lang->slug}}"><i class="ti-plus"></i></span>
                                                      @if($key > 0) <span class="remove_attributes"><i class="ti-minus"></i></span> @endif
                                                  </div>
                                               </div>
                                            @endforeach
                                            @else
                                                <div class="attribute-field-wrapper">
                                                    <input type="text" class="form-control"  id="attributes" name="attributes_title[{{$lang->slug}}][]" placeholder="{{__('Title')}}">
                                                    <textarea name="attributes_description[{{$lang->slug}}][]"  class="form-control" rows="5" placeholder="{{__('Value')}}"></textarea>
                                                    <div class="icon-wrapper">
                                                        <span class="add_attributes" data-lang="{{$lang->slug}}"><i class="ti-plus"></i></span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="meta_title">{{__('Meta Title')}}</label>
                                                <input type="text" name="meta_title[{{$lang->slug}}]" value="{{$data->meta_title}}" class="form-control" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="og_meta_title">{{__('OG Meta Title')}}</label>
                                                <input type="text" name="og_meta_title[{{$lang->slug}}]" value="{{$data->og_meta_title}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="meta_description">{{__('Meta Description')}}</label>
                                                <textarea name="meta_description[{{$lang->slug}}]" class="form-control" rows="5" id="meta_description">{{$data->meta_description}}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="og_meta_description">{{__('OG Meta Description')}}</label>
                                                <textarea name="og_meta_description[{{$lang->slug}}]" class="form-control" rows="5" id="og_meta_description">{{$data->og_meta_description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="meta_tags">{{__('Meta Tags')}}</label>
                                                <input type="text" name="meta_tags[{{$lang->slug}}]" class="form-control" data-role="tagsinput"
                                                    id="meta_tags" value="{{$data->meta_tags}}" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                    <label for="og_meta_image[{{$lang->slug}}]">{{__('OG Meta Image')}}</label>
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
                                                        <input type="hidden" id="og_meta_image[{{$lang->slug}}]" name="og_meta_image[{{$lang->slug}}]" value="{{$data->og_meta_image}}">
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
                                <select name="category_id" class="form-control" id="category">
                                    <option value="">{{__("Select Category")}}</option>
                                    @foreach($all_categories as $category)
                                        <option @if($product->category_id == $category->id) selected @endif value="{{$category->id}}">{{purify_html(optional($category->lang)->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="regular_price">{{__('Regular Price')}}</label>
                                    <input type="number" class="form-control"  id="regular_price" name="regular_price" value="{{$product->regular_price}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sale_price">{{__('Sale Price')}}</label>
                                    <input type="number" class="form-control"  id="sale_price" name="sale_price" value="{{$product->sale_price}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="sku">{{__('SKU')}}</label>
                                    <input type="text" class="form-control"  id="sku" name="sku" value="{{$product->sku}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="stock_status">{{__('Stock')}}</label>
                                    <select name="stock_status" class="form-control" id="stock_status">
                                        <option @if($product->stock_status == 'in_stock') selected @endif value="in_stock">{{__('In Stock')}}</option>
                                        <option @if($product->stock_status == 'out_stock') selected @endif value="out_stock">{{__('Out Of Stock')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_downloadable"><strong>{{__('Is Downloadable')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox"  @if($product->is_downloadable) checked @endif name="is_downloadable" id="is_downloadable">
                                    <span class="slider-yes-no"></span>
                                </label>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="downloadable_file">{{__('Downloadable File')}}</label>
                                <p class="info-text">
                                    @if(file_exists('assets/uploads/downloadable/'.$product->downloadable_file))
                                        <a href="{{route('admin.products.file.download',$product->id)}}" target="_blank">{{$product->downloadable_file}}</a>
                                    @endif
                                </p>
                                <input type="file" name="downloadable_file"  class="form-control" id="downloadable_file">
                                <span class="info-text text-danger">{{__('only zip file is allowed')}}</span>
                            </div>
                            <x-fields.image :name="'image'" :id="$product->image" :title="__('Image')" :dimentions="'1920 x 1280'"/>
                            <div class="form-group">
                                <label for="image">{{__('Gallery')}}</label>
                                @php
                                    $gallery_images = !empty( $product->gallery) ? explode('|', $product->gallery) : [];
                                @endphp
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @foreach($gallery_images as $gl_img)
                                            @php
                                                $work_section_img = get_attachment_image_by_id($gl_img,null,true);
                                            @endphp
                                            @if (!empty($work_section_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$work_section_img['img_url']}}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="gallery" value="{{$product->gallery}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-mulitple="true" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__('Upload Image')}}
                                    </button>
                                </div>
                                <small>{{__('Recommended image size 1920x1280')}}</small>
                            </div>
                            @if(get_static_option('product_tax_type') == 'individual')
                            <div class="form-group">
                                <label for="tax_percentage">{{__('Tax Percentage')}}</label>
                                <input type="number" class="form-control"  id="tax_percentage" name="tax_percentage" value="{{$product->tax_percentage}}">
                            </div>
                            @endif
                            <x-fields.status :name="'status'" :title="__('Status')" :value="$product->status"/>
                            <button type="submit" id="save" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Save Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
    (function ($){
    "use strict";
        $(document).ready(function () {
            <x-btn.save/>
            $(document).on('change','#is_downloadable',function (e) {
                e.preventDefault();
                isDownloadableCheck('#is_downloadable');
            });
            $(document).on('change','#is_downloadable',function (e) {
                e.preventDefault();
                isDownloadableCheck('#is_downloadable');
            });
            $(document).on('click','.attribute-field-wrapper .add_attributes',function (e) {
               e.preventDefault();
                var selectedLang = $(this).parent().parent().data('language');
                $(this).parent().parent().parent().append(' <div class="attribute-field-wrapper">\n' +
                    '<input type="text" class="form-control"  id="attributes" name="attributes_title['+selectedLang+'][]" placeholder="{{__('Title')}}">\n' +
                    '<textarea name="attributes_description['+selectedLang+'][]"  class="form-control" rows="5" placeholder="{{__('Value')}}"></textarea>\n' +
                    '<div class="icon-wrapper">\n' +
                    '<span class="add_attributes"><i class="ti-plus"></i></span>\n' +
                    '<span class="remove_attributes"><i class="ti-minus"></i></span>\n' +
                    '</div>\n' +
                    '</div>');

            });
            isDownloadableCheck('#is_downloadable');
            $(document).on('click','.attribute-field-wrapper .remove_attributes',function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });

            function isDownloadableCheck($selector) {
                var dnFile = $('#downloadable_file');
                var dnFileUrl = $('#downloadable_file_link');
                if($($selector).is(':checked')){
                    dnFile.parent().show();
                    dnFileUrl.parent().show();
                }else{
                    dnFile.parent().hide();
                    dnFileUrl.parent().hide();
                }
            }
        });
    })(jQuery)
    </script>
    <x-media.js/>
    <x-summernote.js/>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
@endsection
