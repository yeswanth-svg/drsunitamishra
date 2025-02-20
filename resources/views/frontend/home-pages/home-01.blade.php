<div class="header-style-01">
    @if (get_static_option('home_page_topbar_section_status')) <!--topbar-area -->
        @include('frontend.partials.topbar')
    @endif
    @if(get_static_option('home_page_infobar_section_status')) <!--infobar-area -->
        @include('frontend.partials.infobar.infobar-variant-home-'.$home_variant_number)
    @endif
    @if(get_static_option('home_page_navbar_section_status'))  <!--navbar-area -->
        @include('frontend.partials.navbar.navbar-variant-home-'.$home_variant_number)
    @endif
</div>
@if(get_static_option('home_page_header_slider_section_status')) <!--header-slider-area -->
    <div class="header-slider-one">
        @foreach ($heaer_sliders as $data)
        <div class="header-area header-bg" {!! render_background_image_markup_by_attachment_id($data->image) !!}>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-inner">
                            <!-- header inner -->
                            <span class="subtitle">{{$data->subtitle}}</span>
                            <h1 class="title">{{$data->title}}</h1>
                            <div class="header-bottom">
                                @if(!empty($data->btn_status))
                                <div class="btn-wrapper desktop-left">
                                    <a href="{{$data->btn_url}}" class="boxed-btn">{{$data->btn_text}}</a>
                                </div>
                                <span class="or">{{__('OR')}}</span>
                                @endif
                                <div class="header-buttom-content style-01">
                                    <p>{{$data->support_title}}</p>
                                    <span>{{$data->support_details}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- //.header inner -->
                    </div>
                </div>
            </div>
        </div>    
        @endforeach
    </div>
@endif
@if(get_static_option('home_page_keyfeature_section_status'))<!--keyfeature-area -->
    @include('frontend.partials.keyfeature.keyfeature-variant-04')
@endif
@if(get_static_option('home_page_why_choose_us_section_status'))<!--why-choose-us-area -->
    @include('frontend.partials.why-choose-us-variant.why-choose-us-variant-'.get_static_option('why_choose_us_home_'.$home_variant_number.'_variant'))
@endif
@if(get_static_option('home_page_full_width_service_section_status'))<!--full-width-service-area -->
    @include('frontend.partials.full-width-service.full-width-service-variant-01')
@endif
@if(get_static_option('home_page_counterup_section_status'))<!--counterup-area -->
    @include('frontend.partials.counterup-area')
@endif
@if(get_static_option('home_page_testimonial_section_status'))<!--testimonial-area -->
    @include('frontend.partials.testimonial.testimonial-variant-01')
@endif
@if(get_static_option('home_page_quote_section_status'))<!--quote-area -->
    @include('frontend.partials.quote-area')
@endif
@if(get_static_option('home_page_price_plan_section_status'))<!--price-plan-area -->
    @include('frontend.partials.price-plan-area')
@endif
@if(get_static_option('home_page_latest_team_member_section_status'))<!--team-member-area -->
    @include('frontend.partials.team-member-area')
@endif
@if(get_static_option('home_page_latest_blog_section_status'))<!--keyfeature-area -->
    @include('frontend.partials.blog-latest-area')
@endif

