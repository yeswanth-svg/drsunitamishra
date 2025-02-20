@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Payment Success For:')}} {{$order_details->package_name}}
@endsection
@section('content')
    <div class="package-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area margin-bottom-80 text-center">
                        <h1 class="title">{{get_static_option('site_order_success_page_' . $user_select_lang_slug . '_title')}}</h1>
                        <p class="order-page-description">{{get_static_option('site_order_success_page_' . $user_select_lang_slug . '_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="billing-title">{{__('Order Details')}}</h2>
                    <ul class="billing-details">
                        <li><strong>{{__('Order ID')}}</strong> #{{$order_details->id}}</li>
                        <li><strong>{{__('Payment Method')}}</strong> {{str_replace('_',' ',$payment_details->package_gateway)}}</li>
                        <li><strong>{{__('Payment Status')}}</strong> {{$payment_details->status}}</li>
                        <li><strong>{{__('Transaction id')}}</strong> {{$payment_details->transaction_id}}</li>
                    </ul>
                    <h2 class="billing-title">{{__('Billing Details')}}</h2>
                    <ul class="billing-details">
                        <li><strong>{{__('Name')}}</strong> {{$payment_details->name}}</li>
                        <li><strong>{{__('Email')}}</strong> {{$payment_details->email}}</li>
                    </ul>
                    <div class="btn-wrapper margin-top-40">
                        @if(auth()->guard('web')->check())
                            <a href="{{route('user.home')}}" class="boxed-btn">{{__('Go To Dashboard')}}</a>
                        @else
                            <a href="{{url('/')}}" class="boxed-btn">{{__('Back To Home')}}</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 mt-3">
                    <div class="right-content-area">
                        <div class="single-price-plan-01 active">
                            <div class="price-header">
                                <div class="img-icon">
                                    {!! render_image_markup_by_attachment_id($package_details->image) !!}
                                </div>
                                <h4 class="title">{{$package_details->lang_front->title}}</h4>
                            </div>
                            <div class="price-body">
                                <ul>
                                    @foreach(explode("\n",$package_details->lang_front->features) as $item)
                                        <li><i class="fa fa-check success"></i> {{$item}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="price-wrap">
                                {!! custom_amount_with_currency_symbol($package_details->price) !!} <span class="sign">{{ $package_details->lang_front->type }}</span>
                            </div>
                            <div class="price-footer">
                                <div class="btn-wrapper">
                                    <a href="{{ ($package_details->btn_url)?? route('frontend.plan.order',['id' => $package_details->id]) }}" class="boxed-btn">{{$package_details->lang_front->btn_text}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
