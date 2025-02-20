@extends('backend.admin-master')
@section('style')
<link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@include('backend.partials.datatable.style-enqueue')
@endsection
@section('site-title')
    {{__('All Admins')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    @include('backend/partials/message')
                                    @include('backend/partials/error')
                                    <h4 class="header-title">{{__('All Admin Created By Super Admin')}}</h4>
                                    <div class="data-tables datatable-primary">
                                        <table id="all_user_table" class="text-center">
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th>{{__('ID')}}</th>
                                                <th>{{__('Name')}}</th>
                                                <th>{{__('Username')}}</th>
                                                <th>{{__('Image')}}</th>
                                                <th>{{__('Role')}}</th>
                                                <th>{{__('Email')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($all_user as $data)
                                                <tr>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->username}}</td>
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
                                                    <td>{{$data->role}}</td>
                                                    <td>{{$data->email}}</td>
                                                    <td>
                                                        <x-delete-popover :url="route('admin.delete.user',$data->id)"/>
                                                        <a href="#"
                                                           data-id="{{$data->id}}"
                                                           data-name="{{$data->name}}"
                                                           data-role="{{$data->role}}"
                                                           data-email="{{$data->email}}"
                                                           data-imageid="{{$data->image}}"
                                                           data-image="{{$img_url}}"
                                                           data-toggle="modal"
                                                           data-target="#user_edit_modal"
                                                           class="btn btn-lg btn-primary btn-sm mb-3 mr-1 user_edit_btn"
                                                        >
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                        <a href="#"
                                                           data-id="{{$data->id}}"
                                                           data-toggle="modal"
                                                           data-target="#user_change_password_modal"
                                                           class="btn btn-lg btn-info btn-sm mb-3 mr-1 user_change_password_btn"
                                                        >
                                                            {{__("Change Password")}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('User Details Edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                @include('backend/partials/error')
                <form action="{{route('admin.user.update')}}" id="user_edit_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control"  id="name" name="name" placeholder="{{__('Enter name')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input type="text" class="form-control"  id="email" name="email" placeholder="{{__('Email')}}">
                        </div>
                        <div class="form-group">
                            <label for="role">{{__('Role')}}</label>
                            <select name="role" id="role" class="form-control">
                                <option value="editor">{{__("Editor")}}</option>
                                <option value="admin">{{__("Admin")}}</option>
                                <option value="super_admin">{{__('Super Admin')}}</option>
                            </select>
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
                        <button type="submit" class="btn btn-primary">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_change_password_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Change Admin Password')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                @include('backend/partials/error')
                <form action="{{route('admin.user.password.change')}}" id="user_password_change_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="ch_user_id" id="ch_user_id">
                        <div class="form-group">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" class="form-control" name="password" placeholder="{{__('Enter Password')}}">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Change Password')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <!-- Start datatable js -->
    @include('backend.partials.datatable.script-enqueue')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
    (function($){
    "use strict";
    $(document).ready(function() {
        $(document).on('click','.user_change_password_btn',function(e){
            e.preventDefault();
            var el = $(this);
            var form = $('#user_password_change_modal_form');
            form.find('#ch_user_id').val(el.data('id'));
        });
        $('#all_user_table').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
        $(document).on('click','.user_edit_btn',function(e){
            e.preventDefault();
            var form = $('#user_edit_modal_form');
            var el = $(this);
            form.find('#user_id').val(el.data('id'));
            form.find('#name').val(el.data('name'));
            form.find('#username').val(el.data('username'));
            form.find('#email').val(el.data('email'));
            form.find('#modal_preview_image').attr('src',el.data('image'));
            form.find('#role option[value='+el.data('role')+']').attr('selected',true);
            var image = el.data('image');
            var imageid = el.data('imageid');
            if(imageid != ''){
                form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="'+image+'" > </div></div></div>');
                form.find('.media-upload-btn-wrapper input').val(imageid);
                form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
            }
        })

    } );
            
    })(jQuery);
    </script>
@endsection
