@extends('backend.admin-master')
@section('style')
<x-datatable.css/>
@endsection
@section('site-title')
    {{__('All Product Reviews')}}
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
                                    <x-msg.success/>
                                    <x-msg.error/>
                                    <h4 class="header-title">{{__('All Product Reviews')}}</h4>
                                    <x-bulk-action/>
                                    <div class="data-tables datatable-primary table-responsive">
                                        <table id="all_user_table" >
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th>{{__('Review ID')}}</th>
                                                <th>{{__('Product Name')}}</th>
                                                <th>{{__('Reviewer Name')}}</th>
                                                <th>{{__('Ratings')}}</th>
                                                <th>{{__('Date')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($all_ratings as $data)
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td>{{$data->id}}</td>
                                                    <td>
                                                        @if(!empty($data->product))
                                                        <a href="{{route('frontend.products.single',['slug'=>$data->product->lang->slug ?? 'x' ,'id'=>optional($data->product)->id])}}" target="_blank">{{optional(optional($data->product)->lang)->title}}</a>
                                                        @else
                                                            <div class="alert alert-warning">{{__('Product deleted or not available')}}</div>
                                                        @endif
                                                    </td>
                                                    <td>{{get_user_name_by_id($data->user_id) ? get_user_name_by_id($data->user_id)->name : __('anonymous')}}</td>
                                                    <td><div class="ratings text-warning">{!! render_ratings($data->ratings) !!}</div></td>
                                                    <td>{{date_format($data->created_at,'d M Y')}}</td>
                                                    <td>
                                                        <x-delete-popover :url="route('admin.products.ratings.delete',$data->id)"/>
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

@endsection

@section('script')
<x-datatable.js/>
    <script>
(function ($){
"use strict";
        $(document).ready(function($) {

            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });
                if(allIds != '' && bulkOption == 'delete'){
                    $(this).text('Deleting...');
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.products.ratings.bulk.action')}}",
                        'data' : {
                            _token: "{{csrf_token()}}",
                            ids: allIds
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

            $('#all_user_table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );

        } );
    })(jQuery)
    </script>
@endsection

