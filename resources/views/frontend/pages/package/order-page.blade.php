@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Order For')}} {{' : '.optional($order_details->lang_front)->title}}
@endsection
@section('content')
<section class="order-service-page-content-area padding-100">
    <div class="container">
        <div class="row reorder-xs justify-content-between ">
            <div class="col-lg-6">
                @if(!empty(get_static_option('guest_order_system_status')))
                <div class="order-content-area">
                    <h3 class="order-title">{{get_static_option('order_page_'.$user_select_lang_slug.'_form_title')}}</h3>
                    @include('backend.partials.message')
                    @include('backend.partials.error')
                   <div class="order-tab-wrap">
                       <nav>
                           <div class="nav nav-tabs" role="tablist">
                               @if(!auth()->check())
                               <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"  aria-selected="true"><i class="fas fa-user"></i></a>
                               @endif
                               <a class="nav-item nav-link  @if(auth()->check()) active @else disabled @endif" disabled id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-address-book"></i></a>
                           </div>
                       </nav>
                       <div class="tab-content" >
                           @if(!auth()->check())
                           <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                               <div class="checkout-type margin-bottom-30"  @if(auth()->check()) style="display: none"  @endif>
                                   <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="guest_logout" name="checkout_type">
                                       <label class="custom-control-label" for="guest_logout">{{__('Guest Order')}}</label>
                                   </div>
                               </div>
                               @if(!auth()->check())
                                   <div class="login-form">
                                       <form action="{{route('user.login')}}" method="post" enctype="multipart/form-data" class="contact-page-form style-01" id="login_form_order_page">
                                           @csrf
                                           <div class="error-wrap"></div>
                                           <div class="form-group">
                                               <input type="text" name="username" class="form-control" placeholder="{{__('Username')}}">
                                           </div>
                                           <div class="form-group">
                                               <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                           </div>
                                           <div class="form-group btn-wrapper">
                                                <button class="boxed-btn btn-saas btn-block" id="login_btn" type="submit">{{__('Login')}}</button>
                                           </div>
                                           <div class="row mb-4 rmber-area">
                                               <div class="col-6">
                                                   <div class="custom-control custom-checkbox ">
                                                       <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                                       <label class="custom-control-label" for="remember">{{__('Remember Me')}}</label>
                                                   </div>
                                               </div>
                                               <div class="col-6 text-right">
                                                   <a class="d-block" href="{{route('user.register')}}">{{__('Create new account?')}}</a>
                                                   <a href="{{route('user.forget.password')}}">{{__('Forgot Password?')}}</a>
                                               </div>
                                           </div>
                                       </form>
                                   </div>
                               @else
                                   <div class="alert alert-success">
                                        {{__('Your Are Logged In As ')}} {{ auth()->user()->name}}
                                   </div>
                               @endif
                               @if(!auth()->check())
                               <div class="form-group btn-wrapper">
                                    <button class="next-step-button btn-small ds-none" style="display: none" id="login_btn" type="submit">{{__('Next Step')}}</button>
                                </div>
                               @endif
                           </div>
                           @endif
                           <div class="tab-pane fade @if(auth()->check()) show active @endif" id="nav-profile" role="tabpanel">
                            <form action="{{route('frontend.order.message')}}" method="post" enctype="multipart/form-data" class="contact-page-form style-01">
                                @csrf
                                <input type="hidden" name="package" value="{{$order_details->id}}">
                                <input type="hidden" name="pkg_user_name" id="pkg_user_name" value="">
                                <input type="hidden" name="pkg_user_email" id="pkg_user_email" value="">
                                <div class="form-group"> <input type="text" id="order_name" name="name" @if(auth()->check()) value="{{ auth()->user()->name }}" @endif class="form-control" placeholder="Name" required></div>
                                <div class="form-group"> <input type="email" id="order_email" name="email" @if(auth()->check())  value="{{ auth()->user()->email }}" @endif class="form-control" placeholder="Your Email" required></div>
                                    {!! render_form_field_for_frontend(get_static_option('order_page_form_fields')) !!}
                                    {!! render_payment_gateway_for_form() !!}
                                <div class="form-group btn-wrapper">
                                    <button class="boxed-btn btn-saas btn-block" type="submit" id="order_pkg_btn">{{__('Order Package')}}</button>
                                </div>
                            </form>
                           </div>
                       </div>
                   </div>
                </div>
                @else
                <div class="order-tab-wrap">
                    <h3 class="order-title">{{get_static_option('order_page_'.$user_select_lang_slug.'_form_title')}}</h3>
                    @include('backend.partials.message')
                    @include('backend.partials.error')
                    @if(!auth()->check())
                        @if(!auth()->check())
                            <div class="login-form">
                                <form action="{{route('user.login')}}" method="post" enctype="multipart/form-data" class="contact-page-form style-01" id="login_form_order_page">
                                    @csrf
                                    <div class="alert alert-warning alert-block">
                                     <button type="button" class="close" data-dismiss="alert">×</button>
                                     <strong>{{ __('You must login or create an account to order your package!') }}</strong>
                                     </div>
                                    <div class="error-wrap"></div>
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="{{__('Username')}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                    </div>
                                    <div class="form-group btn-wrapper">
                                     <button class="boxed-btn btn-saas btn-block" id="login_btn" type="submit">{{__('Login')}}</button>
                                    </div>
                                    <div class="row mb-4 rmber-area">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                                <label class="custom-control-label" for="remember">{{__('Remember Me')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a class="d-block" href="{{route('user.register')}}">{{__('Create new account?')}}</a>
                                            <a href="{{route('user.forget.password')}}">{{__('Forgot Password?')}}</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-success">
                                 {{__('Your Are Logged In As ')}} {{ auth()->user()->name}}
                            </div>
                        @endif
                    @endif
                    @if(auth()->check())
                    <form action="{{route('frontend.order.message')}}" method="post" enctype="multipart/form-data" class="contact-page-form style-01">
                                @csrf
                                <input type="hidden" name="package" value="{{$order_details->id}}">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <div class="form-group"> <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"  class="form-control" placeholder="Name" readonly></div>
                                    <div class="form-group"> <input type="email" id="email" name="email"  value="{{ auth()->user()->email }}" class="form-control" placeholder="Your Email" readonly></div>
                                        {!! render_form_field_for_frontend(get_static_option('order_page_form_fields')) !!}
                                        {!! render_payment_gateway_for_form() !!}
                                    </div>
                                    <div class="col-lg-12">
                                    <div class="form-group btn-wrapper">
                                        <button class="boxed-btn btn-saas btn-block" type="submit">{{__('Order Package')}}</button>
                                    </div>
                                    </div>
                                </div>
                    </form>
                    @endif
                </div>
                @endif
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 mt-3">
                <div class="right-content-area">
                    <div class="single-price-plan-01 active">
                        <div class="price-header">
                            <div class="img-icon">
                                {!! render_image_markup_by_attachment_id($order_details->image) !!}
                            </div>
                            <h4 class="title">{{optional($order_details->lang_front)->title}}</h4>
                        </div>
                        <div class="price-body">
                            <ul>
                                @foreach(explode("\n",optional($order_details->lang_front)->features) as $item)
                                    <li><i class="fa fa-check success"></i> {{$item}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="price-wrap">
                            {!! custom_amount_with_currency_symbol($order_details->price) !!} <span class="sign">{{ optional($order_details->lang_front)->type }}</span>
                        </div>
                        <div class="price-footer">
                            <div class="btn-wrapper">
                                <a href="{{ ($order_details->btn_url)?? route('frontend.plan.order',['id' => $order_details->id]) }}" class="boxed-btn">{{optional($order_details->lang_front)->btn_text}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    <script>
    (function($){
    "use strict";
    $(document).ready(function ($) {
    
    $(document).on('click','#order_pkg_btn', function(){
        var name = $("#order_name").val()
        var email = $("#order_email").val()
        sessionStorage.pkg_user_name = name;
        sessionStorage.pkg_user_email = email;
    })
    $(document).on('click', '#login_btn', function (e) {
        e.preventDefault();
        var formContainer = $('#login_form_order_page');
        var el = $(this);
        var username = formContainer.find('input[name="username"]').val();
        var password = formContainer.find('input[name="password"]').val();
        var remember = formContainer.find('input[name="remember"]').val();

        el.text('{{__("Please Wait")}}');

        $.ajax({
            type: 'post',
            url: "{{route('user.ajax.login')}}",
            data: {
                _token: "{{csrf_token()}}",
                username : username,
                password : password,
                remember : remember,
            },
            success: function (data){
                if(data.status == 'invalid'){
                    el.text('{{__("Login")}}')
                    formContainer.find('.error-wrap').html('<div class="alert alert-danger">'+data.msg+'</div>');
                }else{
                    formContainer.find('.error-wrap').html('');
                    el.text('{{__("Login Success.. Redirecting ..")}}');
                    location.reload();
                }
            },
            error: function (data){
                var response = data.responseJSON.errors
                formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                $.each(response,function (value,index){
                    formContainer.find('.error-wrap ul').append('<li>'+value+'</li>');
                });
                el.text('{{__("Login")}}');
            }
        });
    });
    var defaulGateway = $('#site_global_payment_gateway').val();
    $('.payment-gateway-wrapper ul li[data-gateway="'+defaulGateway+'"]').addClass('selected');

    $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
        e.preventDefault();
        $(this).addClass('selected').siblings().removeClass('selected');
        $('.payment-gateway-wrapper').find(('input')).val($(this).data('gateway'));
    });

    $(document).on('change','#guest_logout',function (e) {
        e.preventDefault();
        var infoTab = $('#nav-profile-tab');
        var nextBtn = $('.next-step-button');
        if($(this).is(':checked')){
            $('.login-form').hide();
            infoTab.attr('disabled',false).removeClass('disabled');
            nextBtn.show();
        }else{
            $('.login-form').show();
            infoTab.attr('disabled',true).addClass('disabled');
            nextBtn.hide();
        }
    });
    $(document).on('click','.next-step-button',function(e){
        var infoTab = $('#nav-profile-tab');
        infoTab.attr('disabled',false).removeClass('disabled').addClass('active').siblings().removeClass('active');
        $('#nav-profile').addClass('show active').siblings().removeClass('show active');
    });

});
            
    })(jQuery);    
    </script>
@endsection
