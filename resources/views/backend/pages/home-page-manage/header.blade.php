@extends('backend.admin-master')
@section('site-title')
    {{__('Header Settings')}}
@endsection
@section('style')
<x-media.css/>
<x-datatable.css/>
@endsection
@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="margin-top-40"></div>
            <x-msg.success/>
            <x-msg.error/>
        </div>
        <div class="col-lg-6 mt-t">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('All Header Slider')}}</h4>
                    <x-bulk-action/>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @php $a=0; @endphp
                        @foreach($all_header_slider as $key => $slider)
                        <li class="nav-item">
                            <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                        </li>
                            @php $a++; @endphp
                        @endforeach
                    </ul>
                    <div class="tab-content margin-top-40" id="myTabContent">
                        @php $b=0; @endphp
                        @foreach($all_header_slider as $key => $slider)
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
                                   <th>{{__('Image')}}</th>
                                   <th>{{__('Title')}}</th>
                                   <th>{{__('Action')}}</th>
                                   </thead>
                                   <tbody>
                                   @foreach($slider as $data)
                                       <tr>
                                           <td><x-bulk-delete-checkbox :id="$data->id"/></td>
                                           <td>{{$data->id}}</td>
                                           <td>@php $img = get_attachment_image_by_id($data->image,null,true); @endphp
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
                                           <td>{{($home_page_variant_number == '02')? $data->title_ext : $data->title }}</td>
                                           <td>
                                                <x-delete-popover :url="route('admin.home.header.delete',$data->id)"/>
                                                <a href="#"
                                                    data-toggle="modal"
                                                    data-target="#header_slider_item_edit_modal"
                                                    class="btn btn-lg btn-primary btn-sm mb-3 mr-1 header_slider_edit_btn"
                                                    data-id="{{$data->id}}"
                                                    data-title="{{$data->title}}"
                                                    data-subtitle="{{$data->subtitle}}"
                                                    data-title_ext="{{$data->title_ext}}"
                                                    data-subtitle_ext="{{$data->subtitle_ext}}"
                                                    data-details="{{$data->details}}"
                                                    data-btn_text="{{$data->btn_text}}"
                                                    data-btn_url="{{$data->btn_url}}"
                                                    data-support_title="{{$data->support_title}}"
                                                    data-support_details="{{$data->support_details}}"
                                                    data-icon="{{$data->icon}}"
                                                    data-btn_status="{{$data->btn_status}}"
                                                    data-imageid="{{$data->image}}"
                                                    data-image="{{$img_url}}"
                                                    data-lang="{{$data->lang}}">
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
                    <h4 class="header-title">{{__('New Header Slider')}}</h4>
                    <form action="{{route('admin.home.header')}}" method="post" enctype="multipart/form-data">@csrf
                        <x-add-language/>
                        
                        @if($home_page_variant_number == '02')
                        <div class="form-group">
                            <label for="title_ext">{{__('Title')}}</label>
                            <input type="text" class="form-control"  id="title_ext"  name="title_ext" placeholder="{{__('Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="subtitle_ext">{{__('Sub Title')}}</label>
                            <input type="text" class="form-control"  id="subtitle_ext"  name="subtitle_ext" placeholder="{{__('Sub Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="details">{{__('Details')}}</label>
                            <input type="text" class="form-control"  id="details"  name="details" placeholder="{{__('Details')}}">
                        </div>
                        <x-add-icon :name="'icon'" :id="'icon'" :title="__('Icon')"/>
                        @else
                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" class="form-control"  id="title"  name="title" placeholder="{{__('Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">{{__('Sub Title')}}</label>
                            <input type="text" class="form-control"  id="subtitle"  name="subtitle" placeholder="{{__('Sub Title')}}">
                        </div>
                        @endif
                        @if($home_page_variant_number != '02')
                        <div class="form-group">
                            <label for="support_title">{{__('Support Title')}}</label>
                            <input type="text" class="form-control"  id="support_title"  name="support_title" placeholder="{{__('Support Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="support_details">{{__('Support Details')}}</label>
                            <input type="text" class="form-control"  id="support_details"  name="support_details" placeholder="{{__('Support Details')}}">
                        </div>
                        @endif
                        @if(in_array($home_page_variant_number,['01','03']))
                        <div class="form-group">
                            <label for="btn_status">{{__('Button Show/Hide')}}</label>
                            <label class="switch">
                                <input type="checkbox" name="btn_status" id="btn_status">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="form-group  col-md-6">
                                <label for="btn_text">{{__('Button Text')}}</label>
                                <input type="text" class="form-control"  id="btn_text"  name="btn_text" placeholder="{{__('Button Text')}}">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="btn_url">{{__('Button URL')}}</label>
                                <input type="text" class="form-control"  id="btn_url"  name="btn_url" placeholder="{{__('Button URL')}}">
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="image">{{__('Image')}}</label>
                            <x-image :id="'image'" :name="'image'" :value="'image'"/>
                            <small class="form-text text-danger">{{__('* jpg,jpeg,png')}}</small>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="header_slider_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Header Slider Item')}}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{route('admin.home.header.update')}}" id="header_slider_edit_modal_form"  method="post" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="header_slider_id" value="">
                    <x-edit-language/>
                    @if($home_page_variant_number == '02')
                    <div class="form-group">
                        <label for="title_ext">{{__('Title')}}</label>
                        <input type="text" class="form-control"  id="edit_title_ext"  name="title_ext" placeholder="{{__('Title')}}">
                    </div>
                    <div class="form-group">
                        <label for="subtitle_ext">{{__('Sub Title')}}</label>
                        <input type="text" class="form-control"  id="edit_subtitle_ext"  name="subtitle_ext" placeholder="{{__('Sub Title')}}">
                    </div>
                    <div class="form-group">
                        <label for="details">{{__('Details')}}</label>
                        <input type="text" class="form-control"  id="edit_details"  name="details" placeholder="{{__('Details')}}">
                    </div>
                    <x-add-icon :name="'icon'" :id="'edit_icon'" :title="__('Icon')"/>
                    @else
                    <div class="form-group">
                        <label for="title">{{__('Title')}}</label>
                        <input type="text" class="form-control"  id="edit_title"  name="title" placeholder="{{__('Title')}}">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">{{__('Sub Title')}}</label>
                        <input type="text" class="form-control"  id="edit_subtitle"  name="subtitle" placeholder="{{__('Sub Title')}}">
                    </div>
                    @endif
                    @if($home_page_variant_number != '02')
                    <div class="form-group">
                        <label for="support_title">{{__('Support Title')}}</label>
                        <input type="text" class="form-control"  id="edit_support_title"  name="support_title" placeholder="{{__('Support Title')}}">
                    </div>
                    <div class="form-group">
                        <label for="support_details">{{__('Support Details')}}</label>
                        <input type="text" class="form-control"  id="edit_support_details"  name="support_details" placeholder="{{__('Support Details')}}">
                    </div>
                    @endif
                    @if(in_array($home_page_variant_number,['01','03']))
                    <div class="form-group">
                        <label for="btn_status">{{__('Button Show/Hide')}}</label>
                        <label class="switch">
                            <input type="checkbox" name="btn_status" id="edit_btn_status">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="row">
                        <div class="form-group  col-md-6">
                            <label for="btn_text">{{__('Button Text')}}</label>
                            <input type="text" class="form-control"  id="edit_btn_text"  name="btn_text" placeholder="{{__('Button Text')}}">
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="btn_url">{{__('Button URL')}}</label>
                            <input type="text" class="form-control"  id="edit_btn_url"  name="btn_url" placeholder="{{__('Button URL')}}">
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="image">{{__('Image')}}</label>
                        <x-image :id="'image'" :name="'image'" :value="'image'"/>
                        <small class="form-text text-danger">{{__('* jpg,jpeg,png')}}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" id="save" class="btn btn-primary">{{__('Save Changes')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <x-media.markup/>
@endsection
@section('script')
<x-media.js/>
<x-datatable.js/>
<script>
    (function($){
    "use strict";
    $(document).ready(function () {
        <x-btn.update/>
        <x-btn.save/>
        <x-btn.submit/>
        <x-bulk-action-js :url="route('admin.home.header.bulk.action')" />
        $(document).on('click','.header_slider_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var imageid = el.data('imageid');
                var image = el.data('image');
                var action = el.data('action');
                var form = $('#header_slider_edit_modal_form');
                form.attr('action',action);
                form.find('#header_slider_id').val(id);
                form.find('#edit_title').val(el.data('title'));
                form.find('#edit_subtitle').val(el.data('subtitle'));
                form.find('#edit_title_ext').val(el.data('title_ext'));
                form.find('#edit_subtitle_ext').val(el.data('subtitle_ext'));
                form.find('#edit_details').val(el.data('details'));
                form.find('#edit_btn_text').val(el.data('btn_text'));
                form.find('#edit_btn_url').val(el.data('btn_url'));
                form.find('#edit_btn_status').val(el.data('btn_status'));
                form.find('#edit_icon').val(el.data('icon'));
                form.find('#edit_support_title').val(el.data('support_title'));
                form.find('#edit_support_details').val(el.data('support_details'));
                form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);
                form.find('.icp-dd').attr('data-selected',el.data('icon'));
                form.find('.iconpicker-component i').attr('class',el.data('icon'));
                if(imageid != ''){
                    form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="'+image+'" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }
                if(el.data('btn_status') == 'on'){
                    $('#edit_btn_status').prop('checked',true);
                }else{
                    $('#edit_btn_status').prop('checked',false);
                }
            });
            <x-icon-picker/>
    });
    })(jQuery);
</script>
@endsection
