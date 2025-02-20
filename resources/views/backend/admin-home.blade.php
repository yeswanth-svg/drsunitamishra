@extends('backend.admin-master')
@section('site-title')
    {{__('Dashboard')}}
@endsection
@section('content')
@php
    $statistics = [
        ['title' => 'Total Admin','value' => $total_admin, 'icon' => 'user-secret'],
        ['title' => 'Total User','value' => $total_user, 'icon' => 'user'],
        ['title' => 'Total Blogs','value' => $blog_count, 'icon' => 'blog'],
        ['title' => 'Total Key Feature','value' => $total_key_features, 'icon' => 'key'],
        ['title' => 'Total Testimonial','value' => $total_testimonial, 'icon' => 'comments'],
        ['title' => 'Total Price Plan','value' => $total_price_plan,'icon' => 'tags'],
        ['title' => 'Total Products Order','value' => $total_product_order, 'icon' => 'shopping-cart'],
        ['title' => 'Total Appointments','value' => $total_appointment, 'icon' => 'calendar-check'],
        ['title' => 'Total Services','value' => $total_services, 'icon' => 'headset'],
    ];
@endphp
    <div class="main-content-inner">
        <div class="row">
            <!-- seo fact area start -->
            <div class="col-lg-12">
                <div class="row">
                    @foreach ($statistics as $data)
                    <div class="col-md-4 mt-5 mb-3">
                        <div class="card card-hover">
                            <div class="dash-box text-white">
                                <h1 class="dash-icon">
                                    <i class="fas fa-{{ $data['icon'] }} mb-1 font-16"></i>
                                </h1>
                                <div class="dash-content">
                                    <h5 class="mb-0 mt-1">{{ $data['value'] }}</h5>
                                    <small class="font-light">{{ __($data['title']) }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title">{{__('Recent Product Order')}}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>{{__('Order ID')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Payment Gateway')}}</th>
                                    <th>{{__('Payment Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($product_recent_order as $data)
                                        <tr>
                                            <td>#{{$data->id}}</td>
                                            <td>{{amount_with_currency_symbol($data->total)}}</td>
                                            <td>{{str_replace('_',' ',$data->payment_gateway)}}</td>
                                            <td>
                                                @php $pay_status = $data->payment_status; @endphp
                                                @if($pay_status == 'complete')
                                                    <span class="alert alert-success">{{$pay_status}}</span>
                                                @elseif($pay_status == 'pending')
                                                    <span class="alert alert-warning">{{$pay_status}}</span>
                                                @endif
                                            </td>
                                            <td>{{date_format($data->created_at,'d M Y h:i:s')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title">{{__('Recent Package Order')}}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th>{{__('Order ID')}}</th>
                                <th>{{__('Package Name')}}</th>
                                <th>{{__('Payment Status')}}</th>
                                <th>{{__('Date')}}</th>
                                </thead>
                                <tbody>
                                @foreach($package_recent_order as $data)
                                    <tr>
                                        <td>#{{$data->id}}</td>
                                        <td>{{$data->package_name}}</td>
                                        <td>
                                            @php $pay_status = $data->payment_status; @endphp
                                            @if($pay_status == 'complete')
                                                <span class="alert alert-success">{{$pay_status}}</span>
                                            @elseif($pay_status == 'pending')
                                                <span class="alert alert-warning">{{$pay_status}}</span>
                                            @endif
                                        </td>
                                        <td>{{date_format($data->created_at,'d M Y h:i:s')}}</td>
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
