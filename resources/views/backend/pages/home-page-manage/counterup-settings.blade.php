@extends('backend.admin-master')
@section('site-title')
    {{__('Counterup Section Settings')}}
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
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Section Settings')}}</h4>
                            <form action="{{route('admin.home.counterup')}}" method="post" enctype="multipart/form-data">@csrf
                                    <div class="form-group mt-2">
                                        <label for="counterup_bg_img">{{__('Background Image')}}</label>
                                        <x-image :id="'counterup_bg_img'" :name="'counterup_bg_img'" :value="'counterup_bg_img'"/>
                                        <small class="form-text text-muted">{{__('1920 x 230 pixels (recommended)')}}</small>
                                    </div>
                                <button type="submit" id="update" class="btn btn-primary">{{__('Update Settings')}}</button>
                            </form>
                        </div>
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
