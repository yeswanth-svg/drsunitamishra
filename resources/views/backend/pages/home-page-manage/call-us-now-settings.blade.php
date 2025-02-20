@extends('backend.admin-master')
@section('site-title')
    {{__('Call Us Now Banner Settings')}}
@endsection
@section('style')
<x-media.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Call Us Now Banner Settings')}}</h4>
                        <form action="{{route('admin.home.callus')}}" method="post" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="home_page_quote_support_image">{{__('Contact Info Image')}}</label>
                                <x-image :id="'home_page_quote_support_image'" :name="'home_page_quote_support_image'" :value="'home_page_quote_support_image'"/>
                                <small class="form-text text-muted">{{__('1050 x 850 pixels (recommended)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="home_page_quote_bg_image">{{__('Background Image')}}</label>
                                <x-image :id="'home_page_quote_bg_image'" :name="'home_page_quote_bg_image'" :value="'home_page_quote_bg_image'"/>
                                <small class="form-text text-muted">{{__('1050 x 850 pixels (recommended)')}}</small>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('script')
<x-media.js/>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-btn.update/>
        });
        })(jQuery);
    </script>
@endsection
