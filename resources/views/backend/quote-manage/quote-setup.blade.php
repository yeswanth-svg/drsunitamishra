@extends('backend.admin-master')
@section('site-title')
    {{__('Quote Settings')}}
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
                        <h4 class="header-title">{{__('Quote Settings')}}</h4>
                        <form action="{{route('admin.quote.settings')}}" method="post" enctype="multipart/form-data">@csrf
                            <x-lang-nav/>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="quote_mail_{{$lang->slug}}_subject">{{__('Quote Email Success Message')}}</label>
                                        <input type="text" name="quote_mail_{{$lang->slug}}_subject" value="{{get_static_option('quote_mail_'.$lang->slug.'_subject')}}" class="form-control" id="quote_mail_{{$lang->slug}}_subject">
                                    </div>
                                    <div class="form-group">
                                        <label for="quote_page_{{$lang->slug}}_form_title">{{__('Quote Page form Title')}}</label>
                                        <input type="text" name="quote_page_{{$lang->slug}}_form_title" value="{{get_static_option('quote_page_'.$lang->slug.'_form_title')}}" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="quote_page_{{$lang->slug}}_form_button_text">{{__('Quote Page form Button Text')}}</label>
                                        <input type="text" name="quote_page_{{$lang->slug}}_form_button_text" value="{{get_static_option('quote_page_'.$lang->slug.'_form_button_text')}}" class="form-control" >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="quote_page_form_mail">{{__('Email Address For Quote Message')}}</label>
                                <input type="text" name="quote_page_form_mail" value="{{get_static_option('quote_page_form_mail')}}" class="form-control" id="quote_page_form_mail">
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-btn.update/>
        });
        })(jQuery);
    </script>
@endsection