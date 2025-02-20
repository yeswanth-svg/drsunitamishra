@extends('backend.admin-master')
@section('site-title')
    {{__('All Shipping')}}
@endsection
@section('style')
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Shipping')}}</h4>
                        <x-bulk-action/>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_shipping as $key => $slider)
                                <li class="nav-item">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_shipping as $key => $shipping)
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
                                            <th>{{__('Cost')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Action')}}</th>
                                            </thead>
                                            <tbody>
                                            @foreach($shipping as $data)
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->title}}</td>
                                                    <td>{{amount_with_currency_symbol($data->cost)}}</td>
                                                    <td><x-status-span :status="$data->status"/></td>
                                                    <td>
                                                        <x-delete-popover :url="route('admin.products.shipping.delete',$data->id)"/>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#category_edit_modal"
                                                           class="btn btn-primary btn-xs mb-3 mr-1 category_edit_btn"
                                                           data-id="{{$data->id}}"
                                                           data-title="{{$data->title}}"
                                                           data-lang="{{$data->lang}}"
                                                           data-cost="{{$data->cost}}"
                                                           data-description="{{$data->description}}"
                                                           data-order="{{$data->order}}"
                                                           data-status="{{$data->status}}">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                        @if($data->is_default == '1')
                                                            <div class="alert alert-success">{{__('Default Shipping')}}</div>
                                                        @else
                                                            <form action="{{route('admin.products.shipping.default',$data->id)}}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-info btn-sm mb-3 mr-1 set_default_menu">{{__('Set Default')}}</button>
                                                            </form>
                                                        @endif
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
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Shipping')}}</h4>
                        <form action="{{route('admin.products.shipping.new')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="language">{{__('Language')}}</label>
                                <select name="lang" id="language" class="form-control">
                                    @foreach($all_languages as $language)
                                        <option value="{{$language->slug}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control"  id="title" name="title" placeholder="{{__('Title')}}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('Description')}}</label>
                                <textarea name="description" id="description" class="form-control max-height-120" cols="30" rows="10" placeholder="{{__('Description')}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="cost">{{__('Cost')}}</label>
                                <input type="text" class="form-control"  id="cost" name="cost" placeholder="{{__('Cost')}}">
                            </div>
                            <div class="form-group">
                                <label for="order">{{__('Order')}}</label>
                                <input type="text" class="form-control"  id="order" name="order" placeholder="{{__('Order')}}">
                            </div>
                            <div class="form-group">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="publish">{{__("Publish")}}</option>
                                    <option value="draft">{{__("Draft")}}</option>
                                </select>
                            </div>
                            <button type="submit" id="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Shipping')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="category_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Update Shipping')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.products.shipping.update')}}"  method="post">
                    <input type="hidden" name="id" id="shipping_id">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="edit_language">{{__('Language')}}</label>
                            <select name="lang" id="edit_language" class="form-control">
                                @foreach($all_languages as $language)
                                    <option value="{{$language->slug}}">{{$language->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_title">{{__('Title')}}</label>
                            <input type="text" class="form-control"  id="edit_title" name="title" placeholder="{{__('Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_description">{{__('Description')}}</label>
                            <textarea name="description" id="edit_description" class="form-control max-height-120" cols="30" rows="10" placeholder="{{__('Description')}}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_cost">{{__('Cost')}}</label>
                            <input type="text" class="form-control"  id="edit_cost" name="cost" placeholder="{{__('Cost')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_order">{{__('Order')}}</label>
                            <input type="text" class="form-control"  id="edit_order" name="order" placeholder="{{__('Order')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_status">{{__('Status')}}</label>
                            <select name="status" class="form-control" id="edit_status">
                                <option value="draft">{{__("Draft")}}</option>
                                <option value="publish">{{__("Publish")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" id="save" class="btn btn-primary">{{__('Save Change')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        (function ($){
            "use strict";
        $(document).ready(function () {
            <x-btn.save/>
            <x-btn.submit/>
            <x-bulk-action-js :url="route('admin.products.shipping.bulk.action')" />
            $(document).on('click','.category_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var name = el.data('title');
                var status = el.data('status');
                var modal = $('#category_edit_modal');
                modal.find('#shipping_id').val(id);
                modal.find('#edit_title').val(name);
                modal.find('#edit_order').val(el.data('order'));
                modal.find('#edit_cost').val(el.data('cost'));
                modal.find('#edit_description').val(el.data('description'));
                modal.find('#edit_status option[value="'+status+'"]').attr('selected',true);
                modal.find('#edit_language option[value="'+el.data('lang')+'"]').attr('selected',true);
            });
        });
    })(jQuery)
    </script>
    <!-- Start datatable js -->
    <x-datatable.js/>
@endsection
