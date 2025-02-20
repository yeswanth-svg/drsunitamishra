@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    @include('backend.partials.dropzone.style-enqueue')
    @include('backend.partials.datatable.style-enqueue')
@endsection
@section('site-title')
    {{__('Services Section')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-6 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Services Section Items')}}</h4>
                        <x-bulk-action/>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_services as $key => $services)
                                <li class="nav-$all_services">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_services as $key => $services)
                                <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab_{{$key}}" role="tabpanel" >
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default">
                                        <thead>
                                            <th class="no-sort">
                                                <div class="mark-all-checkbox">
                                                    <input type="checkbox" class="all-checkbox">
                                                </div>
                                            </th>
                                            <th>{{__('ID')}}</th>
                                            <th>{{__('Title')}}</th>
                                            <th>{{__('Image')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($services as $data)
                                            <tr>
                                                <td>
                                                    <x-bulk-delete-checkbox :id="$data->id"/>
                                                </td>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->title}}</td>
                                                <td> 
                                                    @php
                                                    $img = get_attachment_image_by_id($data->image,null,true);
                                                    @endphp
                                                    @if (!empty($img))
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="{{$img['img_url']}}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php  $img_url = $img['img_url']; @endphp
                                                    @endif
                                                </td>
                                            <td> <x-delete-popover :url="route('admin.services.delete',$data->id)"/>
                                                 <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#services_item_edit_modal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 services_edit_btn"
                                                   data-id="{{$data->id}}"
                                                   data-title="{{$data->title}}"
                                                   data-description='{{$data->description}}'
                                                   data-lang="{{$data->lang}}"
                                                   data-imageid="{{$data->image}}"
                                                   data-image="{{$img_url}}"
                                                >
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                @php $b++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('New Services Section')}}</h4>
                        <form action="{{route('admin.services')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{__('Language')}}</label>
                                <select name="lang" id="language" class="form-control">
                                    @foreach($all_languages as $lang)
                                        <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control"  id="title"  name="title" placeholder="{{__('Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('Description')}}</label>
                                <textarea name="description" class="form-control" id="description" cols="5" rows="5">{{get_static_option("description")}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $image = get_attachment_image_by_id(get_static_option('image'),null,true);
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
                                            @php  $image_btn_label = __( 'Change Image'); @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" id="image" name="image" value="{{get_static_option('image')}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($image_btn_label)}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add Services Section')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="services_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-800px">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Services Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.services.update')}}" id="services_edit_modal_form"   method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="services_id" value="">
                        <div class="form-group">
                            <label for="edit_language">{{__('Languages')}}</label>
                            <select name="lang" id="edit_language" class="form-control">
                                @foreach($all_languages as $lang)
                                <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_title">{{__('Title')}}</label>
                            <input type="text" class="form-control"  id="edit_title"  name="title" placeholder="{{__('Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('Description')}}</label>
                            <textarea name="description" class="form-control" id="edit_description" cols="5" rows="5">{{get_static_option("description")}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="site_favicon">{{__('Image')}}</label>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    @php
                                        $image = get_attachment_image_by_id(get_static_option('image'),null,true);
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
                                <input type="hidden" id="image" name="image" value="{{get_static_option('image')}}">
                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                    {{__($image_btn_label)}}
                                </button>
                            </div>
                            <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
@include('backend.partials.datatable.script-enqueue')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-bulk-action-js :url="route('admin.services.bulk.action')" />
            $(document).on('click','.services_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var description = el.data('description');
                var form = $('#services_edit_modal_form');
                form.find('#services_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_description').val(description);
                form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);
                var image = el.data('image'); 
                var imageid = el.data('imageid');
                if(imageid != ''){
                    form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="'+image+'" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }
            });
        });  
        })(jQuery);        

    </script>
@endsection
