@extends('frontend.user.dashboard.user-master')
@section('section')
    <div class="row">
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01">
                <div class="icon"><i class="fas fa-money-bill"></i></div>
                <div class="content">
                    <h4 class="title">{{__('Package Order')}}</h4>
                    <span class="number">{{$package_orders}}</span>
                </div>
            </div>
        </div>
            <div class="col-lg-6">
                <div class="user-dashboard-card">
                    <div class="icon"><i class="fas fa-shopping-bag"></i></div>
                    <div class="content">
                        <h4 class="title">{{get_static_option('product_page_'.$user_select_lang_slug.'_name')}} {{__('Order')}}</h4>
                        <span class="number">{{$product_orders}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="user-dashboard-card style-01">
                    <div class="icon"><i class="fas fa-calendar"></i></div>
                    <div class="content">
                        <h4 class="title">{{get_static_option('appointment_page_'.$user_select_lang_slug.'_name')}} {{__('Booking')}}</h4>
                        <span class="number">{{$appointments}}</span>
                    </div>
                </div>
            </div>
    </div>
@endsection