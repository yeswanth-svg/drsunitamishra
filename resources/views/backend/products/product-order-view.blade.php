@extends('backend.admin-master')
@section('site-title')
    {{__('Product Order Details')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between margin-bottom-40">
                           <h4 class="header-title">{{__('Product Order Details')}}</h4>
                           <a href="{{route('admin.products.order.logs')}}" class="btn btn-info">{{__('All Product Orders')}}</a>
                       </div>
                       <div class="order-success-area">
                        <div class="product-orders-summery-warp margin-top-20">
                            <h4 class="title">{{__('Order Information')}}</h4>
                            <div class="extra-data booking-details-info">
                                <ul>
                                    <li><strong>{{__('Order ID: ')}}</strong> {{'#'.$product_order->id}}</li>
                                    <li><strong>{{__('Shipping Method:')}}</strong> {{get_shipping_name_by_id($product_order->product_shippings_id)}}</li>
                                    <li><strong>{{__('Payment Method:')}}</strong> {{str_replace('_',' ', ucfirst($product_order->payment_gateway))}}</li>
                                    <li><strong>{{__('Payment Status:')}}</strong> {{__($product_order->payment_status)}}</li>
                                    <li><strong>{{__('Order Status:')}}</strong> {{__($product_order->status)}}</li>
                                </ul>
                            </div>
                            <div class="billing-and-shipping-details booking-details-info margin-top-20">
                                <div class="billing-wrap">
                                    <h4 class="title">{{__('Billing Details')}}</h4>
                                    <ul>
                                        <li><strong>{{__('Name')}}</strong> {{$product_order->billing_name}}</li>
                                        <li><strong>{{__('Email')}}</strong> {{$product_order->billing_email}}</li>
                                        <li><strong>{{__('Phone')}}</strong> {{$product_order->billing_phone}}</li>
                                        <li><strong>{{__('Country')}}</strong> {{$product_order->billing_country}}</li>
                                        <li><strong>{{__('Street Address')}}</strong> {{$product_order->billing_street_address}}</li>
                                        <li><strong>{{__('District')}}</strong> {{$product_order->billing_district}}</li>
                                        <li><strong>{{__('Town')}}</strong> {{$product_order->billing_town}}</li>
                                    </ul>
                                </div>
                                @if($product_order->different_shipping_address == 'yes')
                                    <div class="billing-wrap booking-details-info margin-top-20">
                                        <h4 class="title">{{__('Shipping Details')}}</h4>
                                        <ul>
                                            <li><strong>{{__('Name')}}</strong> {{$product_order->shipping_name}}</li>
                                            <li><strong>{{__('Email')}}</strong> {{$product_order->shipping_email}}</li>
                                            <li><strong>{{__('Phone')}}</strong> {{$product_order->shipping_phone}}</li>
                                            <li><strong>{{__('Country')}}</strong> {{$product_order->shipping_country}}</li>
                                            <li><strong>{{__('Street Address')}}</strong> {{$product_order->shipping_street_address}}</li>
                                            <li><strong>{{__('District')}}</strong> {{$product_order->shipping_district}}</li>
                                            <li><strong>{{__('Town')}}</strong> {{$product_order->shipping_town}}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            @php $cart_items = unserialize($product_order->cart_items,['class' => false]); @endphp
                            <h4 class="title margin-top-20">{{__('Order Summery')}}</h4>
                            <div class="cart-total-table-wrap">
                                <div class="cart-total-table table-responsive text-left">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><strong>{{__('Subtotal')}}</strong></td>
                                            <td>{{amount_with_currency_symbol($product_order->subtotal)}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{__('Coupon Discount')}}</strong></td>
                                            <td>- {{amount_with_currency_symbol($product_order->coupon_discount)}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{__('Shipping Cost')}}</strong></td>
                                            <td>+ {{amount_with_currency_symbol($product_order->shipping_cost)}}</td>
                                        </tr>
                                        @if(is_tax_enable())
                                            @php $tax_percentage = get_static_option('product_tax_type') == 'total' ? '('.get_static_option('product_tax_percentage').')' : '';  @endphp
                                            <tr>
                                                <td><strong>{{__('Tax')}} {{$tax_percentage}}</strong></td>
                                                <td>+ {{amount_with_currency_symbol(cart_tax_for_mail_template($cart_items))}}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td><strong>{{__('Total')}}</strong></td>
                                            <td>{{amount_with_currency_symbol($product_order->total)}}</td>
                                        </tr>
                                    </table>
                                    @if(get_static_option('product_tax') && get_static_option('product_tax_system') == 'inclusive')
                                        <p class="tax-info">{{__('Inclusive of custom duties and taxes where applicable')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="ordered-product-summery margin-top-30">
                            <h4 class="title">{{__('Ordered Products')}}</h4>
                            <table class="table table-bordered">
                                <thead>
                                <th>{{__('Thumbnail')}}</th>
                                <th>{{__('Product Info')}}</th>
                                </thead>
                                <tbody>
                                @foreach($cart_items as $item)
                                    @php 
                                    $product_info = \App\Products::with('lang_front')->find($item['id']);
                                    @endphp
                                    @if($product_info)
                                    <tr>
                                        <td>
                                            <div class="product-thumbnail">
                                                {!! render_image_markup_by_attachment_id($product_info->image ?? '','','thumb') !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-info-wrap">
                                                <h4 class="product-title"><a href="{{route('frontend.products.single',[$product_info->lang_front->slug ?? '',$product_info->id])}}">{{$product_info->lang_front->title ?? __('untitled')}}</a></h4>
                                                <span class="pdetails d-block"><strong>{{__('Price :')}}</strong> {{amount_with_currency_symbol($product_info->sale_price)}}</span>
                                                <span class="pdetails d-block"><strong>{{__('Quantity :')}}</strong> {{$item['quantity']}}</span>
                                                @php $tax_amount = 0; @endphp
                                                @if(get_static_option('product_tax_type') == 'individual' && is_tax_enable())
                                                    @php
                                                        $percentage = !empty($product_info->tax_percentage) ? $product_info->tax_percentage : 0;
                                                        $tax_amount = ($product_info->sale_price * $item['quantity']) / 100 * $product_info->tax_percentage;
                                                    @endphp
                                                    <span class="pdetails d-block text-danger"><strong>{{__('Tax')}} {{'('.$percentage.'%) :'}}</strong> +{{amount_with_currency_symbol($tax_amount)}}</span>
                                                @endif
                                                <span class="pdetails d-block"><strong>{{__('Subtotal :')}}</strong> {{amount_with_currency_symbol($product_info->sale_price * $item['quantity'] + $tax_amount )}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="2"><div class="alert alert-warning">{{__('Product Removed')}}</div></td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
