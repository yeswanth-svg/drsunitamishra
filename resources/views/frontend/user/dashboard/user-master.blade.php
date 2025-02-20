@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('User Dashboard')}}
@endsection
@section('content')
    <section class="login-page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="user-dashboard-wrapper">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="mobile_nav">
                                <i class="fas fa-cogs"></i>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home')) active @endif" href="{{route('user.home')}}">{{__('Dashboard')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.package.order')) active @endif"  href="{{route('user.home.package.order')}}" >{{__('Packages Orders')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.product.order')) active @endif" href="{{route('user.home.product.order')}}">{{get_static_option('product_page_'.$user_select_lang_slug.'_name')}} {{__('Orders')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.product.download')) active @endif" href="{{route('user.home.product.download')}}">{{get_static_option('product_page_'.$user_select_lang_slug.'_name')}} {{__('Downloads')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.appointment.booking')) active @endif" href="{{route('user.home.appointment.booking')}}" >{{__('Booked')}} {{get_static_option('appointment_page_'.$user_select_lang_slug.'_name')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.edit.profile')) active @endif " href="{{route('user.home.edit.profile')}}">{{__('Edit Profile')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.change.password')) active @endif " href="{{route('user.home.change.password')}}">{{__('Change Password')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                    jQuery('#userlogout-form-submit-btn').trigger('click');">
                                    {{ __('Logout') }}
                                </a>
                                <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                    <input type="submit" value="dd" id="userlogout-form-submit-btn" class="d- none">
                                </form>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel">
                                <div class="message-show margin-top-10">
                                    @include('backend.partials.message')
                                    @include('backend.partials.error')
                                </div>
                                @yield('section')
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
                
        $(document).ready(function(){

            $(document).on('click','.user-dashboard-wrapper > ul .mobile_nav',function (e){
               e.preventDefault();
                var el = $(this);

                el.parent().toggleClass('show');

            });

        });
        })(jQuery);
    </script>
@endsection