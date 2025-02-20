@extends('backend.admin-master')
@section('style')
<x-datatable.css/>
@endsection
@section('site-title')
    {{__('All Product Orders')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <x-msg.success/>
                        <x-msg.error/>
                        <h4 class="header-title">{{__('All Product Orders')}}</h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                        </div>
                        <div class="data-tables datatable-primary table-responsive">
                            <table id="all_user_table" >
                                <thead class="text-capitalize">
                                <tr>
                                    <th class="no-sort">
                                        <div class="mark-all-checkbox">
                                            <input type="checkbox" class="all-checkbox">
                                        </div>
                                    </th>
                                    <th>{{__('Order ID')}}</th>
                                    <th>{{__('Billing Name')}}</th>
                                    <th>{{__('Billing Email')}}</th>
                                    <th>{{__('Total Amount')}}</th>
                                    <th>{{__('Package Gateway')}}</th>
                                    <th>{{__('Payment Status')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_orders as $data)
                                    <tr>
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->billing_name}}</td>
                                        <td>{{$data->billing_email}}</td>
                                        <td>{{amount_with_currency_symbol($data->total)}}</td>
                                        <td><strong>{{ucwords(str_replace('_',' ',$data->payment_gateway))}}</strong></td>
                                        <td>
                                            @if($data->payment_status == 'pending')
                                                <span class="alert alert-warning text-capitalize">{{$data->payment_status}}</span>
                                            @else
                                                <span class="alert alert-success text-capitalize">{{$data->payment_status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->status == 'pending')
                                                <span class="alert alert-warning text-capitalize">{{$data->status}}</span>
                                            @elseif($data->status == 'in_progress')
                                                <span class="alert alert-info text-capitalize">{{ucwords(str_replace('_',' ',$data->status))}}</span>
                                            @elseif($data->status == 'shipped')
                                                <span class="alert alert-info text-capitalize">{{$data->status}}</span>
                                            @elseif($data->status == 'complete')
                                                <span class="alert alert-success text-capitalize">{{$data->status}}</span>
                                            @elseif($data->status == 'cancel')
                                                <span class="alert alert-danger text-capitalize">{{$data->status}}</span>
                                            @endif
                                        </td>
                                        <td>{{date_format($data->created_at,'d M Y')}}</td>
                                        <td>
                                            <x-delete-popover :url="route('admin.product.payment.delete',$data->id)"/>
                                            @php $shipping_method = !empty($data->shipping_details->title) ? $data->shipping_details->title : 'not selected'; @endphp
                                            <a href="{{route('admin.products.order.view',$data->id)}}"
                                               class="btn btn-lg btn-primary btn-sm mb-3 mr-1"
                                            >
                                                <i class="ti-eye"></i>
                                            </a>
                                            <a href="#"
                                               data-id="{{$data->id}}"
                                               data-status="{{$data->status}}"
                                               data-toggle="modal"
                                               data-target="#order_status_change_modal"
                                               class="btn btn-lg btn-info btn-sm mb-3 mr-1 order_status_change_btn"
                                            >
                                                {{__("Update Status")}}
                                            </a>
                                            @if(($data->payment_gateway == 'cash_on_delivery' || $data->payment_gateway == 'manual_payment') && $data->payment_status == 'pending')
                                            <x-custom-alert :msg="__('Are you sure to approve this payment?')" :text="__('Approve Payment')" :url="route('admin.products.order.payment.approve',$data->id)"/>
                                               
                                            @endif
                                            @if(!empty($data->user_id) && $data->payment_status == 'pending')
                                                <form action="{{route('admin.product.order.reminder')}}"  method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                    <button class="btn btn-secondary mb-2" id="email_send" type="submit"><i class="fas fa-bell"></i></button>
                                                </form>
                                            @endif
                                            <form action="{{route('frontend.product.invoice.generate')}}"  method="post">
                                                @csrf
                                                <input type="hidden" name="order_id" id="invoice_generate_order_field" value="{{$data->id}}">
                                                <button class="btn btn-secondary" type="submit">{{__('Invoice')}}</button>
                                            </form>

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

    <div class="modal fade" id="view_quote_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="view-quote-details-info" id="view-quote-details-info">
                    <h4 class="title">{{__('View Order Details Information')}}</h4>
                    <div class="view-quote-top-wrap">
                        <div class="status-wrap">
                            {{__('Status:')}} <span class="quote-status-span"></span>
                        </div>
                        <div class="data-wrap">
                           {{__(' Date:')}} <span class="quote-date-span"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="quote-all-custom-fields table-striped table-bordered"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="order_status_change_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Order Status Change')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.product.order.status.change')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="order_id" id="order_id">
                        <div class="form-group">
                            <label for="order_status">{{__('order Status')}}</label>
                            <select name="order_status" class="form-control" id="order_status">
                                <option value="pending">{{__('Pending')}}</option>
                                <option value="in_progress">{{__('In Progress')}}</option>
                                <option value="shipped">{{__('Shipped')}}</option>
                                <option value="cancel">{{__('Cancel')}}</option>
                                <option value="complete">{{__('Complete')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Change Status')}}</button>
                    </div>
                </form>
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
                    $(this).text('{{__('Deleting...')}}');
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.product.order.bulk.action')}}",
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

            $(document).on('click','#genarate_invoice',function (e) {
                e.preventDefault();

                var doc = new jsPDF();
                var elementHTML = $('#pdf_content_wrapper').html();
                var specialElementHandlers = {
                    '#elementH': function (element, renderer) {
                        return true;
                    }
                };
                doc.fromHTML(elementHTML, 15, 15, {
                    'width': 170,
                    'elementHandlers': specialElementHandlers
                });

                // Save the PDF
                doc.save('sample-document.pdf');

            })

            $(document).on('click','.view_quote_details_btn',function (e) {
                e.preventDefault();
                var el = $(this);
                var allData = el.data();
                var parent = $('#view_quote_details_modal');
                var statusClass = allData.status == 'pending' ? 'alert alert-warning' : 'alert alert-success';
                var allProducts = allData.cart_items;
                parent.find('.quote-status-span').text(allData.status).addClass(statusClass);
                parent.find('.quote-date-span').text(allData.date);
                parent.find('.quote-all-custom-fields').html('');
                $('#invoice_generate_order_field').val(el.data('order_id'));
                delete allData.date;
                delete allData.status;
                delete allData.target;
                delete allData.toggle;
                delete allData.order_id;
                delete allData.cart_items;
                $.each(allData,function (index,value) {
                    parent.find('.quote-all-custom-fields').append('<tr><td class="fname">'+index.replace('_',' ')+'</td> <td class="fvalue">'+value+'</td></tr>');
                });
                $.each(allProducts,function (index,value) {
                    parent.find('.quote-all-custom-fields').append('<tr><td class="fname">Product Name</td> <td class="fvalue">'+value.title+'</td></tr>');
                    parent.find('.quote-all-custom-fields').append('<tr><td class="fname">Quantity</td> <td class="fvalue">'+value.quantity+'</td></tr>');
                });
            });
            $('#all_user_table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
            $(document).on('click','.order_status_change_btn',function(e){
                e.preventDefault();
                var el = $(this);
                var form = $('#order_status_change_modal');
                form.find('#order_id').val(el.data('id'));
                form.find('#order_status option[value="'+el.data('status')+'"]').attr('selected',true);
            });
            <x-btn.custom :id="'email_send'" :title="''" />

        } );
    })(jQuery)
    </script>
@endsection

