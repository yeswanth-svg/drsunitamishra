@extends('frontend.frontend-page-master')
@section('page-title')
    {{ get_static_option('quote_page_'.$user_select_lang_slug.'_name') }}
@endsection
@section('site-title')
{{ get_static_option('quote_page_'.$user_select_lang_slug.'_name') }}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('quote_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('quote_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content') 
    @if(get_static_option('contact_page_contact_section_status'))<!-- Contact Area -->
        <div class="contact-inner-area padding-bottom-120 padding-top-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact-form style-01 quote-page">
                            <h4 class="title">{{get_static_option('quote_page_'.$user_select_lang_slug.'_form_title')}} </h4>
                            <x-msg.success/>
                            <x-msg.error/>
                            <form action="{{route('frontend.quote.message')}}" method="POST" class="contact-page-form style-01" id="contact_us_form">
                                @csrf
                                    <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                    {!! render_form_field_for_frontend(get_static_option('quote_page_form_fields')) !!}
                                    <div class="btn-wrapper text-center">
                                        <button type="submit" class="boxed-btn " id="contact_us_submit_btn">{{get_static_option('quote_page_'.$user_select_lang_slug.'_form_button_text')}} </button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    @if(!empty(get_static_option('site_google_captcha_v3_site_key')))
        <script
                src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
        <script>
            (function() {
                "use strict";
                grecaptcha.ready(function () {
                    grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function (token) {
                        document.getElementById('gcaptcha_token').value = token;
                    });
                });
            })();
        </script>
    @endif
    <script>
        (function ($){
            "use strict";
            $(document).on('click','#contact_us_submit_btn',function (){
                $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> {{__("Submitting")}}');
            })
        })(jQuery);
    </script>
@endsection

