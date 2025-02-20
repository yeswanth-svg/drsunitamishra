@extends('backend.admin-master')
@section('site-title')
    {{__('Top Bar Settings')}}
@endsection
@section('style')
@include('backend.partials.datatable.style-enqueue')
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Topbar Info Items')}}  </h4>
                            <div class="header-title">
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" data-toggle="modal" data-target="#add_topbar_info">{{__('Add New topbar Info')}}</button>
                            </div>
                        </div>
                        <x-bulk-action/>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_topbar_infos as $key => $info)
                                <li class="nav-$all_topbar_info">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_topbar_infos as $key => $info)
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
                                        <th>{{__('Icon')}}</th>
                                        <th>{{__('Details')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($info as $data)
                                            <tr>
                                                <td><x-bulk-delete-checkbox :id="$data->id"/></td>
                                                <td>{{$data->id}}</td>
                                                <td><i class="{{ $data->icon }}"></i></td>
                                                <td>{{ $data->details }}</td>
                                                <td>
                                                    <x-delete-popover :url="route('admin.topbar.delete',$data->id)"/>
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#topbar_info_item_edit_modal"
                                                       class="btn btn-primary btn-xs mb-3 mr-1 topbar_info_edit_btn"
                                                       data-id="{{$data->id}}"
                                                       data-action="{{route('admin.topbar.update')}}"
                                                       data-icontopbar="{{$data->icon}}"
                                                       data-details="{{$data->details}}"
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
        </div>
    </div>

    <div class="modal fade" id="add_topbar_info" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add New topbar Info')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.topbar.settings')}}"  method="post">
                    <div class="modal-body">
                        @csrf
                        <x-add-language/>
                        <div class="form-group">
                            <label for="icon" class="d-block">{{__('Social Profile Icon')}}</label>
                            <div class="btn-group icon">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-phone"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-phone" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">{{__('Toggle Dropdown')}}</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control"  id="icon" value="fas fa-phone" name="icon">
                        </div>
                        <div class="form-group">
                            <label for="details">{{__('Details')}}</label>
                            <input type="text" class="form-control"  id="details" name="details" placeholder="{{__('Details')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Add New Item')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="topbar_info_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit topbar Info')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.topbar.update')}}" id="topbar_info_item_edit_modal_form"  method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="topbar_info_id" name="id" value="">
                        <x-edit-language/>
                        <div class="form-group">
                            <label for="edit_icon" class="d-block">{{__('topbar Info Icon')}}</label>
                            <div class="btn-group edit_icon">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">{{__('Toggle Dropdown')}}</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control"  id="edit_icon" value="fas fa-exclamation-triangle" name="icon">
                        </div>
                        <div class="form-group">
                            <label for="edit_details">{{__('Details')}}</label>
                            <input type="text" class="form-control"  id="edit_details" name="details" placeholder="{{__('Details')}}">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.partials.datatable.script-enqueue')
    <script>
        (function ($){
            "use strict";
        $(document).ready(function () {
            <x-bulk-action-js :url="route('admin.topbar.bulk.action')" />
            <x-icon-picker/>
            $(document).on('click','.topbar_info_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var details = el.data('details');
                var form = $('#topbar_info_item_edit_modal_form');
                form.find('#topbar_info_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_details').val(details);
                form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);
                form.find('#edit_icon').val(el.data('icontopbar'));
                form.find('.edit_icon .icp-dd').attr('data-selected',el.data('icontopbar'));
                form.find('.edit_icon .iconpicker-component i').attr('class',el.data('icontopbar'));
            });
        });
    })(jQuery)
    </script>
@endsection
