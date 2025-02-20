@extends('backend.admin-master')
@section('site-title')
    {{__('Price Plan Section')}}
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Price Plan Items')}}  </h4>
                            <div class="header-title">
                                <a type="button" href="{{route('admin.price.plan.new')}}" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Price Plan')}}</a>
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
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Type')}}</th>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($all_price_plan as $data)
                                        <tr>
                                            <td>
                                                <div class="bulk-checkbox-wrapper">
                                                    <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                </div>
                                            </td>
                                            <td>{{$data->id}}</td>
                                                <td>{{optional($data->lang)->title}}</td>
                                                <td>{{amount_with_currency_symbol($data->price)}}</td>
                                                <td>{{optional($data->lang)->type}}</td>
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
                                            <td>
                                                <x-delete-popover :url="route('admin.price.plan.delete',$data->id)"/>
                                                <x-edit-icon :url="route('admin.price.plan.edit',$data->id)" />
                                                <x-clone-icon :action="route('admin.price.plan.clone')" :id="$data->id"/>
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
<x-datatable.js/>
<x-media.js/>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-bulk-action-js :url="route('admin.price.plan.bulk.action')" />
        });
        })(jQuery);        
    </script>
    
@endsection
