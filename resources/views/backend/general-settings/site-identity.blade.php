@extends('backend.admin-master')
@section('site-title')
    {{__('Site Identity')}}
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
                        <h4 class="header-title">{{__("Site Identity Settings")}}</h4>
                        <form action="{{route('admin.general.site.identity')}}" method="POST" enctype="multipart/form-data">@csrf
                            <x-add-icon :name="'site_heading_icon'" :id="'site_heading_icon'" :value="'site_heading_icon'" :title="__('Site Heading Icon')"/>
                            <div class="form-group">
                                <label for="site_logo">{{__('Site Logo')}}</label>
                                <x-image :id="'site_logo'" :name="'site_logo'" :value="'site_logo'"/>
                                <small class="form-text text-muted">{{__('160 x 50 pixels (recommended)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_white_logo">{{__('Site White  Logo')}}</label>
                                <x-image :id="'site_white_logo'" :name="'site_white_logo'" :value="'site_white_logo'"/>
                                <small class="form-text text-muted">{{__('160 x 50 pixels (recommended)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_favicon">{{__('Favicon')}}</label>
                                <x-image :id="'site_favicon'" :name="'site_favicon'" :value="'site_favicon'"/>
                                <small class="form-text text-muted">{{__('40 x 40 pixels (recommended)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_breadcrumb_img">{{__('Breadcrumb Background')}}</label>
                                <x-image :id="'site_breadcrumb_img'" :name="'site_breadcrumb_img'" :value="'site_breadcrumb_img'"/>
                                <small class="form-text text-muted">{{__('1920 x 540 pixels (recommended)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_footer_img">{{__('Footer Background')}}</label>
                                <x-image :id="'site_footer_img'" :name="'site_footer_img'" :value="'site_footer_img'"/>
                                <small class="form-text text-muted">{{__('1920 x 476 pixels (recommended)')}}</small>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('admin.upload.media.file.all')}}" method="post">
        @csrf
        <input type="submit" value="test">
    </form>
    <x-media.markup/>
@endsection
@section('script')
<x-media.js/>
<script>
    (function($){
    "use strict";
        $(document).ready(function () {
            <x-btn.update/>
            <x-icon-picker/>
        });
    })(jQuery);
</script>
@endsection