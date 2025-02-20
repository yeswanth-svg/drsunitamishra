<div class="contact-area bg-image padding-top-110 padding-bottom-120" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_quote_bg_image')) !!}>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-img bg-image">
                    {!! render_image_markup_by_attachment_id(get_static_option('home_page_quote_support_image')) !!}
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="request-page-form-wrap">
                    <div class="section-title bg-image" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_quote_bg_texture')) !!}>
                        <h4 class="title">{{get_static_option('home_page_quote_section_'.$user_select_lang_slug.'_title')}}</h4>
                        <p>{{get_static_option('home_page_quote_section_'.$user_select_lang_slug.'_details')}}</p>
                        
                    </div>
                    @include('frontend.partials.quote-form.quote-form-render')
                </div>
            </div>
        </div>
    </div>
</div>