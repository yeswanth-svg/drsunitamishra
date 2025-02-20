<x-msg.success/>
<x-msg.error/>
<form action="{{route('frontend.quote.message')}}" method="POST" class="request-page-form {{($home_variant_number == '03')? 'style-01' : ''}}" enctype="multipart/form-data" id="quote_form">@csrf
    {!! render_form_field_for_frontend(get_static_option('quote_page_form_fields')) !!}
    <input type="hidden" name="captcha_token" id="gcaptcha_token">
        <div class="form-group">
            <input type="submit" id="quote_submit_btn" value="{{get_static_option('home_page_quote_section_'.$user_select_lang_slug.'_btn_text')}}" class="submit-btn">
        </div>
</form>