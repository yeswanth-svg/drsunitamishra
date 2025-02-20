@extends('backend.admin-master')
@section('site-title')
    {{__('Service Single Settings')}}
@endsection
@section('style')
    <x-media.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Service Single Settings")}}</h4>
                        <form action="{{route('admin.services.single.page.settings')}}" method="POST" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="service_page_banner">{{__('Banner Image')}}</label>
                                <x-image :id="'service_page_banner'" :name="'service_page_banner'" :value="'service_page_banner'"/>
                                <small class="form-text text-muted">{{__('1050 x 850 pixels (recommended)')}}</small>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
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