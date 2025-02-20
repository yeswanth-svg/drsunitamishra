@extends('backend.admin-master')
@section('site-title')
    {{__('New Appointment')}}
@endsection
@section('style')
    <x-summernote.css/>
    <x-media.css/>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('Add New Appointment')}}</h4>
                            <a href="{{route('admin.appointment.all')}}" class="btn btn-info">{{__('All Appointments')}}</a>
                        </div>
                        
                        <form action="{{route('admin.appointment.new')}}" method="post" enctype="multipart/form-data">@csrf
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
                                            <label for="designation">{{__('Designation')}}</label>
                                            <input type="text" class="form-control" name="designation[{{$lang->slug}}]" placeholder="{{__('Designation')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Description')}}</label>
                                            <input type="hidden" name="description[{{$lang->slug}}]">
                                            <div class="summernote"></div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 ">
                                                <label for="location">{{__('Location')}}</label>
                                                <input type="text" name="location[{{$lang->slug}}]" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label for="slug">{{__('Slug')}}</label>
                                                <input type="text" class="form-control" name="slug[{{$lang->slug}}]" placeholder="{{__('Slug')}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="short_description">{{__('Short Description')}}</label>
                                            <textarea name="short_description[{{$lang->slug}}]" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="iconbox-repeater-wrapper dynamic-repeater">
                                            <label for="additional_info" class="d-block">{{__('Additional Info')}}</label>
                                            <div class="all-field-wrap">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="additional_info[{{$lang->slug}}][]"  placeholder="{{__('Additional info')}}">
                                                    </div>
                                                <div class="action-wrap">
                                                    <span class="add"><i class="ti-plus"></i></span>
                                                    <span class="remove"><i class="ti-trash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="iconbox-repeater-wrapper  dynamic-repeater">
                                            <label for="experience_info" class="d-block">{{__('Experience Info')}}</label>
                                            <div class="all-field-wrap">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="experience_info[{{$lang->slug}}][]" placeholder="{{__('Experience Info')}}">
                                                </div>
                                                <div class="action-wrap">
                                                    <span class="add"><i class="ti-plus"></i></span>
                                                    <span class="remove"><i class="ti-trash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="iconbox-repeater-wrapper  dynamic-repeater">
                                                <label for="specialized_info" class="d-block">{{__('Specialized Info')}}</label>
                                            <div class="all-field-wrap">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="specialized_info[{{$lang->slug}}][]" placeholder="{{__('Specialized Info')}}">
                                                </div>
                                                <div class="action-wrap">
                                                    <span class="add"><i class="ti-plus"></i></span>
                                                    <span class="remove"><i class="ti-trash"></i></span>
                                                </div>
                                            </div>
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
                                    @foreach($appointment_category as $category)
                                            <option value="{{$category->id}}">{{purify_html(optional($category->lang)->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="booking_time_ids">{{__('Booking Time')}}</label>
                                <input type="hidden" name="booking_time_ids">
                                <ul class="time_slot">
                                    @forelse($all_booking_time as $data)
                                        <li data-id="{{$data->id}}">{{purify_html($data->time)}}</li>
                                    @empty
                                        <li>{{__('add appointment time first')}}</li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="appointment_status"><strong>{{__('Available For Appointment')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="appointment_status">
                                    <span class="slider-yes-no"></span>
                                </label>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="max_appointment">{{__('Max Appointment')}}</label>
                                    <input type="number" name="max_appointment" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="price">{{__('Price')}}</label>
                                    <input type="number" name="price" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <x-image :id="'image'" :name="'image'" :value="'image'"/>
                                <small class="form-text text-muted">{{__('350 x 500 pixels (recommended)')}}</small>
                            </div>
                            <x-fields.status :name="'status'" :title="__('Status')"/>
                            <button type="submit" id="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('script')
    <x-repeater/>
    <script>
    (function ($){
        "use strict";
        $(document).ready(function () {
            <x-btn.submit/>
            $(document).on('click','ul.time_slot li',function (e){
                e.preventDefault();
                //prent selector
                var parent = $(this).parent().parent();
                //append input field value by this id
                var ids = parent.find('input[name="booking_time_ids"]');
                var oldValue = ids.val()
                //assign new value =
                var id = $(this).data('id');
                if(oldValue != ''){
                    var oldValAr = oldValue.split(',');
                    if($(this).hasClass('selected')){
                        var oldValAr = oldValAr.filter(function (item){return item != id;});
                    }else{
                        oldValAr.push(id);
                    }
                    ids.val(oldValAr.toString());
                }else{
                    ids.val(id);
                }
                //add class for this li
                $(this).toggleClass('selected');
            });
        });
    })(jQuery)
    </script>
    <x-summernote.js/>
    <x-media.js/>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
@endsection
