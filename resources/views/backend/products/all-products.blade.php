@extends('backend.admin-master')
@section('site-title')
    {{__('All Products')}}
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
                            <h4 class="header-title">{{__('All Products')}}  </h4>
                            <div class="header-title">
                                <a href="{{route('admin.products.new')}}" class="btn btn-primary mt-4 pr-4 pl-4" >{{__('Add New Products')}}</a>
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
                                <th>{{__('Image')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Sales')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($all_products as $data)
                                        <tr class="{{ $data['id']}}">
                                            <td>
                                                <div class="bulk-checkbox-wrapper">
                                                    <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                </div>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{optional($data->lang)->title}}</td>
                                            <td>
                                               <div class="img-wrap">
                                                   @php
                                                       $event_img = get_attachment_image_by_id($data->image,'thumbnail',true);
                                                   @endphp
                                                   @if (!empty($event_img))
                                                       <div class="attachment-preview">
                                                           <div class="thumbnail">
                                                               <div class="centered">
                                                                   <img class="avatar user-thumb" src="{{$event_img['img_url']}}" alt="">
                                                               </div>
                                                           </div>
                                                       </div>
                                                   @endif
                                               </div>
                                            </td>
                                            <td><del>{{ amount_with_currency_symbol($data->regular_price) }}</del> <span>{{amount_with_currency_symbol($data->sale_price)}}</span></td>
                                            <td>{{$data->category ? optional(optional($data->category)->lang)->name : __('Anonymous')}}</td>
                                            <td>{{ $data->sales }}</td>
                                            <td><x-status-span :status="$data->status"/></td>
                                            <td>
                                                <x-delete-popover :url="route('admin.products.delete',$data->id)"/>
                                                <x-edit-icon :url="route('admin.products.edit',$data->id)"/>
                                                <x-view-icon :url="route('frontend.products.single',['slug'=>$data->lang->slug ?? 'x','id'=>$data->id])"/>
                                                <x-clone-icon :action="route('admin.products.clone')" :id="$data->id"/>
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
@endsection
@section('script')
<x-datatable.js/>
<x-media.js/>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-bulk-action-js :url="route('admin.products.bulk.action')" />
        });
        })(jQuery);
    </script>
@endsection



