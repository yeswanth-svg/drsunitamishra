@extends('backend.admin-master')
@section('site-title')
    {{__('Progressbar Settings')}}
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
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-7 mt-t">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Progressbar Items')}}  </h4>
                            <div class="header-title">
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" data-toggle="modal" data-target="#add_progressbar">{{__('Add New Item')}}</button>
                            </div>
                        </div>
                        <x-bulk-action/>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_progressbar as $key => $progress)
                                <li class="nav-$all_progressbar">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_progressbar as $key => $progress)
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
                                            <th>{{__('Progress')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($progress as $data)
                                            <tr>
                                                <td><x-bulk-delete-checkbox :id="$data->id"/></td>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->title}}</td>
                                                    <td>{{$data->progress}}</td>
                                                    <td>
                                                        <x-delete-popover :url="route('admin.progressbar.delete',$data->id)"/>
                                                        <a href="#"
                                                        data-toggle="modal"
                                                        data-target="#social_item_edit_modal"
                                                        class="btn btn-lg btn-primary btn-sm mb-3 mr-1 social_item_edit_btn"
                                                        data-id="{{$data->id}}"
                                                        data-title="{{$data->title}}"
                                                        data-progress="{{$data->progress}}">
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
            <div class="col-lg-5 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Progressbar Settings')}}</h4>
                        <form action="{{route('admin.about.progressbar')}}" method="post" enctype="multipart/form-data">@csrf
                            <x-lang-nav/>
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="about_page_progressbar_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" name="about_page_progressbar_section_{{$lang->slug}}_title" value="{{get_static_option('about_page_progressbar_section_'.$lang->slug.'_title')}}">
                                    </div>
                                </div>
                               @endforeach
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Background Image')}}</label>
                                <x-image :id="'about_page_progressbar_section_bg'" :name="'about_page_progressbar_section_bg'" :value="'about_page_progressbar_section_bg'"/>
                                <small class="form-text text-muted">{{__('1050 x 850 pixels (recommended)')}}</small>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Social Icon Modal -->
    <div class="modal fade" id="add_progressbar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add Social Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.progressbar')}}"  method="post">@csrf
                    <div class="modal-body">
                        <x-add-language/>
                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" name="title" id="title"  class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('Progress')}}</label>
                            <input type="number" name="progress" id="progress" class="form-control" min="0" max="100">
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
    <div class="modal fade" id="social_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Social Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.progressbar.update')}}"  method="post">@csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="progressbar" value="">
                        <x-edit-language/>
                        <div class="form-group">
                            <label for="title">{{__('Title')}}</label>
                            <input type="text" name="title" id="edit_title"  class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('Progress')}}</label>
                            <input type="number" name="progress" id="edit_progress"  class="form-control" min="0" max="100">
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
                <x-btn.save/>
                <x-btn.submit/>
                <x-btn.update/>
                <x-bulk-action-js :url="route('admin.progressbar.bulk.action')" />
                $(document).on('click','.social_item_edit_btn',function(){
                    var el = $(this);
                    var id = el.data('id');
                    var title = el.data('title');
                    var progress = el.data('progress');
                    var form = $('#social_item_edit_modal');
                    form.find('#progressbar').val(id);
                    form.find('#edit_title').val(title);
                    form.find('#edit_progress').val(progress);
                    form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);
                });
            })
        })(jQuery);
    </script>
@endsection
