@extends('backend.admin-master')
@section('site-title')
    {{__('Counterup Item')}}
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
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Counterup Items')}}  </h4>
                            <div class="header-title">
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" data-toggle="modal" data-target="#counterup_item_add_modal">{{__('Add New Counterup Items')}}</button>
                            </div>
                        </div>
                        <x-bulk-action/>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_counterup as $key => $countu)
                                <li class="nav-item">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_counterup as $key => $counterup)
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
                                        <th>{{__('Number')}}</th>
                                        <th>{{__('Extra Text')}}</th>
                                        <th>{{__('Icon')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($counterup as $data)
                                            <tr>
                                                <td><x-bulk-delete-checkbox :id="$data->id"/></td>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->title}}</td>
                                                <td>{{$data->number}}</td>
                                                <td>{{$data->extra_text}}</td>
                                                <td class="icon-view"><i class="{{$data->icon}}"></i></td>
                                                <td>
                                                    <x-delete-popover :url="route('admin.counterup.delete',$data->id)"/>
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#counterup_item_edit_modal"
                                                       class="btn btn-lg btn-primary btn-sm mb-3 mr-1 counterup_edit_btn"
                                                       data-id="{{$data->id}}"
                                                       data-action="{{route('admin.counterup.update')}}"
                                                       data-title="{{$data->title}}"
                                                       data-number="{{$data->number}}"
                                                       data-lang="{{$data->lang}}"
                                                       data-icon="{{$data->icon}}"
                                                       data-extra="{{$data->extra_text}}"
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
        </div>
    </div>
    <div class="modal fade" id="counterup_item_add_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add New Counterup Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.counterup')}}" method="post" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <x-add-language/>
                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" class="form-control"  id="title"  name="title" placeholder="{{__('Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="number">{{__('Number')}}</label>
                            <input type="float" class="form-control"  id="number"  name="number" placeholder="{{__('Number')}}">
                        </div>
                        <div class="form-group">
                            <label for="extra_text">{{__('Extra Text')}}</label>
                            <input type="text" class="form-control"  id="extra_text"  name="extra_text" placeholder="{{__('Extra Text')}}">
                        </div>
                        <x-add-icon :name="'icon'" :id="'icon'" :title="__('Icon')"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" id="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="counterup_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Counterup Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="#" id="counterup_edit_modal_form"  method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="counterup_id" value="">
                        <x-edit-language/>
                        <div class="form-group">
                            <label for="edit_title">{{__('Title')}}</label>
                            <input type="text" class="form-control"  id="edit_title" name="title" placeholder="{{__('Title')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_number">{{__('Number')}}</label>
                            <input type="float" class="form-control"  id="edit_number"  name="number" placeholder="{{__('Number')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_extra_text">{{__('Extra Text')}}</label>
                            <input type="text" class="form-control"  id="edit_extra_text"  name="extra_text" placeholder="{{__('Extra Text')}}">
                        </div>
                        <x-add-icon :name="'icon'" :id="'edit_icon'" :title="__('Icon')"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" id="save" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
        "use strict";
        
        $(document).ready(function () {
            <x-btn.save/>
            <x-btn.submit/>
            <x-bulk-action-js :url="route('admin.counterup.bulk.action')" />
            <x-icon-picker/>
            $(document).on('click','.counterup_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var number = el.data('number');
                var action = el.data('action');
                var extra = el.data('extra');
                var form = $('#counterup_edit_modal_form');
                form.attr('action',action);
                form.find('#counterup_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_number').val(number);
                form.find('#edit_extra_text').val(extra);
                form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);
                form.find('#edit_icon').val(el.data('icon'));
                form.find('.edit_icon .icp-dd').attr('data-selected',el.data('icon'));
                form.find('.edit_icon .iconpicker-component i').attr('class',el.data('icon'));
            });
        });
        })(jQuery);
    </script>
    <!-- Start datatable js -->
    @include('backend.partials.datatable.script-enqueue')
@endsection
