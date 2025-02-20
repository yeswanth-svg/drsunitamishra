@extends('backend.admin-master')
@section('site-title')
    {{__('Key Features Section')}}
@endsection
@section('style')
<x-datatable.css/>
<x-media.css/>
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
                            <h4 class="header-title">{{__('Key Feature Items')}}  </h4>
                            <div class="header-title">
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" data-toggle="modal" data-target="#add_new_key_features">{{__('Add New Key Feature')}}</button>
                            </div>
                        </div>
                        <x-bulk-action/>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_key_features as $key => $features)
                                <li class="nav-$all_key_features">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_key_features as $key => $features)
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
                                        @if($home_page_variant_number == '01')
                                        <th>{{__('Image')}}</th>
                                        @endif
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Icon')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($features as $data)
                                            <tr>
                                                <td><x-bulk-delete-checkbox :id="$data->id"/></td>
                                                <td>{{$data->id}}</td>
                                                @if($home_page_variant_number == '01')
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
                                                @endif
                                                <td>{{$data->title}}</td>
                                                <td class="icon-view"><i class="{{$data->icon}}"></i></td>
                                                <td>
                                                    <x-delete-popover :url="route('admin.keyfeatures.delete',$data->id)"/>
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#key_features_item_edit_modal"
                                                       class="btn btn-primary btn-xs mb-3 mr-1 key_features_edit_btn"
                                                       data-id="{{$data->id}}"
                                                       data-action="{{route('admin.keyfeatures.update')}}"
                                                       data-title="{{$data->title}}"
                                                       data-subtitle="{{$data->subtitle}}"
                                                       data-icon="{{$data->icon}}"
                                                       data-description="{{$data->description}}"
                                                       data-lang="{{$data->lang}}"
                                                       data-features="{{$data->features}}"
                                                       @if($home_page_variant_number == '01')
                                                       data-imageid="{{$data->image}}"
                                                       data-image="{{$img_url}}"@endif>
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
        </div>
    </div>
    <!-- Start Add New Key Features  -->
             <!-- Modal -->
             <div class="modal fade" id="add_new_key_features" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title">{{__('New Key Features')}}</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                        </div>
                        <form action="{{route('admin.keyfeatures')}}" id="add_new_key_features_modal_form" method="post" enctype="multipart/form-data">@csrf
                            <div class="modal-body">
                                <x-add-language/>
                                <div class="form-group">
                                    <label for="subtitle">{{__('Sub Title')}}</label>
                                    <input type="text" class="form-control"  id="subtitle"  name="subtitle" placeholder="{{__('Sub Title')}}">
                                </div>
                                <div class="form-group">
                                    <label for="title">{{__('Title')}}</label>
                                    <input type="text" class="form-control"  id="title"  name="title" placeholder="{{__('Title')}}">
                                </div>
                                @if($home_page_variant_number == '01')
                                <div class="form-group">
                                    <label for="description">{{__('Description')}}</label>
                                    <textarea class="form-control"  id="description"  name="description" placeholder="{{__('Description')}}" cols="5" rows="3"></textarea>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="features">{{__('Features')}}</label>
                                    <textarea class="form-control"  id="features"  name="features" placeholder="{{__('Features')}}" cols="3" rows="5"></textarea>
                                    <small class="form-text text-muted">{{__('Separate feature by entering a new line.')}}</small> 
                                </div>
                                <div class="row">
                                    @if($home_page_variant_number == '01')
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">{{__('Image')}}</label>
                                                <x-image :id="'image'" :name="'image'" :value="'image'"/>
                                                <small class="form-text text-danger">{{__('* jpg,jpeg,png')}}</small>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <x-add-icon :name="'icon'" :id="'icon'" :title="__('Icon')"/>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                <button type="submit" id="submit" class="btn btn-primary">{{__('Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    <!-- End Add New Key Features  -->
    <div class="modal fade" id="key_features_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Key Feature Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.keyfeatures.update')}}"  method="post" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="key_features_id" value="">
                        <x-edit-language/>
                        <div class="form-group">
                            <label for="subtitle">{{__('Sub Title')}}</label>
                            <input type="text" class="form-control"  id="edit_subtitle"  name="subtitle" placeholder="{{__('Sub Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" class="form-control"  id="edit_title"  name="title" placeholder="{{__('Title')}}">
                        </div>
                        @if($home_page_variant_number == '01')
                        <div class="form-group">
                            <label for="description">{{__('Description')}}</label>
                            <textarea class="form-control"  id="edit_description"  name="description" placeholder="{{__('Description')}}" cols="5" rows="3"></textarea>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="edit_features">{{__('Features')}}</label>
                            <textarea class="form-control"  id="edit_features"  name="features" placeholder="{{__('Features')}}" cols="3" rows="5"></textarea>
                            <small class="form-text text-muted">{{__('Separate feature by entering a new line.')}}</small> 
                        </div>
                        <div class="row">
                            @if($home_page_variant_number == '01')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">{{__('Image')}}</label>
                                    <x-image :id="'image'" :name="'image'" :value="'image'"/>
                                    <small class="form-text text-danger">{{__('* jpg,jpeg,png')}}</small>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6">
                                <x-add-icon :name="'icon'" :id="'edit_icon'" :title="__('Icon')"/>
                            </div>
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
<x-datatable.js/>
<x-media.js/>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-bulk-action-js :url="route('admin.keyfeatures.bulk.action')" />
            <x-btn.save/>
            <x-btn.submit/>
            <x-icon-picker/>
            $(document).on('click','.key_features_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var subtitle = el.data('subtitle');
                var description = el.data('description');
                var icon = el.data('icon');
                var form = $('#key_features_item_edit_modal');
                form.find('#key_features_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_subtitle').val(subtitle);
                form.find('#edit_description').val(el.data('description'));
                form.find('#edit_features').val(el.data('features'));
                form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);
                form.find('#edit_icon').val(el.data('icon'));
                form.find('.edit_icon .icp-dd').attr('data-selected',el.data('icon'));
                form.find('.edit_icon .iconpicker-component i').attr('class',el.data('icon'));
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
