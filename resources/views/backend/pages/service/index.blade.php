@extends('backend.admin-master')
@section('style')
<x-datatable.css/>
<x-media.css/>
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
                        <h4 class="header-title">{{__('Service Items')}}</h4>
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('All Services')}}  </h4>
                            <div class="header-title">
                                <a href="{{route('admin.services.new')}}" class="btn btn-primary mt-4 pr-4 pl-4" >{{__('Add New Service')}}</a>
                            </div>
                        </div>
                        <x-bulk-action/>
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
                                <th>{{__('Status')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Icon')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Sorting Order')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($all_services as $data)
                                        <tr class="{{ $data['id']}}">
                                            <td>
                                                <div class="bulk-checkbox-wrapper">
                                                    <input type="checkbox" class="bulk-checkbox"
                                                        name="bulk_delete[]" value="{{$data->id}}">
                                                </div>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{optional($data->lang)->title}}</td>
                                            <td><x-status-span :status="$data->status"/></td>
                                            <td>
                                                <div class="img-wrap">
                                                    @php
                                                        $event_img = get_attachment_image_by_id($data->image,'thumbnail',true);
                                                    @endphp
                                                    @if (!empty($event_img))
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb"
                                                                        src="{{$event_img['img_url']}}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="@if($data->icon_type == 'icon' || $data->icon_type == '')icon-view @endif">
                                                @if($data->icon_type == 'icon' || $data->icon_type == '')
                                                    <i class="{{$data->icon}}"></i>
                                                @else
                                                    {!!  render_image_markup_by_attachment_id($data->img_icon) !!}
                                                @endif
                                            </td>
                                            <td>{{$data->category ? optional(optional($data->category)->lang)->name : __('Anonymous')}}</td>
                                            <td>{{$data->sr_order}}</td>
                                            <td>{{date_format($data->created_at,'d M Y')}}</td>
                                            <td>
                                                <x-delete-popover :url="route('admin.services.delete',$data->id)"/>
                                                <x-edit-icon :url="route('admin.services.edit',$data->id)"/>
                                                <x-view-icon :url="route('frontend.services.single',['slug'=>$data->lang->slug ?? 'x','id'=>$data->id])"/>
                                                <x-clone-icon :action="route('admin.service.clone')" :id="$data->id" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<x-media.markup/>
@endsection
@section('script')
<script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
<x-datatable.js/>
<x-media.js/>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-bulk-action-js :url="route('admin.services.bulk.action')" />
        });
        })(jQuery);
    </script>
@endsection
