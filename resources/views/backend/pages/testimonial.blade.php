@extends('backend.admin-master')
@section('site-title')
    {{__('Testimonial Section')}}
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
                            <h4 class="header-title">{{__('Testimonial Items')}}  </h4>
                            <div class="header-title">
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" data-toggle="modal" data-target="#add_new_testimonial_items">{{__('Add New Items')}}</button>
                            </div>
                        </div>
                        <x-bulk-action/>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_testimonials as $key => $all_testimonial)
                                <li class="nav-$all_testimonials">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_testimonials as $key => $all_testimonial)
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
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Rating Star')}}</th>
                                            <th>{{__('Description')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($all_testimonial as $data)
                                            <tr>
                                                <td><x-bulk-delete-checkbox :id="$data->id"/></td>
                                                <td>{{$data->id}}</td>
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
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->rating_star}}</td>
                                                <td>{{Str::words($data->description,10)}}</td>
                                                <td> 
                                                    <x-delete-popover :url="route('admin.testimonial.delete',$data->id)"/>
                                                    <a href="#"
                                                    data-toggle="modal"
                                                    data-target="#testimonial_item_edit_modal"
                                                    class="btn btn-primary btn-xs mb-3 mr-1 testimonial_item_edit_btn"
                                                    data-id="{{$data->id}}"
                                                    data-action="{{route('admin.testimonial.update')}}"
                                                    data-name="{{$data->name}}"
                                                    data-description="{{$data->description}}"
                                                    data-rating_star="{{$data->rating_star}}"
                                                    data-lang="{{$data->lang}}"
                                                    data-imageid="{{$data->image}}"
                                                    data-image="{{$img_url}}">
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
    <!-- Start Add New Testimonial  -->
             <!-- Modal -->
             <div class="modal fade" id="add_new_testimonial_items" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title">{{__('New Testimonial')}}</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                        </div>
                        <form action="{{route('admin.testimonial')}}" id="add_new_testimonial_items_modal_form" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <x-add-language/>
                                <div class="form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input type="text" class="form-control"  id="name"  name="name" placeholder="{{__('Name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="rating_star">{{__('Rating Star')}}</label>
                                    <input type="number" class="form-control"  id="rating_star"  name="rating_star" placeholder="{{__('Rating Star')}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">{{__('Description')}}</label>
                                    <textarea class="form-control"  id="description"  name="description" placeholder="{{__('Description')}}" cols="5" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">{{__('Image')}}</label>
                                    <x-image :id="'image'" :name="'image'" :value="'image'"/>
                                    <small class="form-text text-danger">{{__('* jpg,jpeg,png')}}</small>
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
    <!-- End Add New Testimonial  -->

    <div class="modal fade" id="testimonial_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Testimonial Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="#" id="testimonial_edit_modal_form"  method="post" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="testimonial_id" value="">
                        <x-edit-language/>
                        <div class="form-group">
                            <label for="edit_name">{{__('Name')}}</label>
                            <input type="text" class="form-control"  id="edit_name"  name="name" placeholder="{{__('Name')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_rating_star">{{__('Rating Star')}}</label>
                            <input type="number" class="form-control"  id="edit_rating_star"  name="rating_star" placeholder="{{__('Rating Star')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_description">{{__('Description')}}</label>
                            <textarea class="form-control"  id="edit_description"  name="description" placeholder="{{__('Description')}}" cols="5" rows="5"></textarea>
                        </div>
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
<x-datatable.js/>
<x-media.js/>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-bulk-action-js :url="route('admin.testimonial.bulk.action')" />
            <x-btn.save/>
            <x-btn.submit/>
            $(document).on('click','.testimonial_item_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var rating_star = el.data('rating_star');
                var action = el.data('action');
                var description = el.data('description');
                var form = $('#testimonial_edit_modal_form');
                form.attr('action',action);
                form.find('#testimonial_id').val(id);
                form.find('#edit_name').val(name);
                form.find('#edit_description').val(description);
                form.find('#edit_rating_star').val(rating_star);
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
