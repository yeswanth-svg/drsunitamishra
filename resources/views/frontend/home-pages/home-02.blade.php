<div class="header-style-01">
    @if (get_static_option('home_page_topbar_section_status'))<!--topbar-area -->
        @include('frontend.partials.topbar')
    @endif
    @if(get_static_option('home_page_infobar_section_status')) <!--infobar-area -->
        @include('frontend.partials.infobar.infobar-variant-home-'.$home_variant_number)
    @endif
    @if(get_static_option('home_page_navbar_section_status')) <!--navbar-area -->
        @include('frontend.partials.navbar.navbar-variant-home-'.$home_variant_number)
    @endif
</div>
@if(get_static_option('home_page_header_slider_section_status'))
    <div class="header-slider-one">
        @foreach ($heaer_sliders as $data)
        <div class="header-area style-01 header-bg-02" {!! render_background_image_markup_by_attachment_id($data->image) !!}>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="header-inner-02">
                            <!-- header inner -->
                            <div class="content">
                                <div class="icon">
                                    <i class="{{$data->icon}}"></i>
                                </div>
                                <span class="subtitle">{{$data->subtitle_ext}}</span>
                                <h1 class="title">{{$data->title_ext}}</h1>
                                <p>{{$data->details}}</p>
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
@if(get_static_option('home_page_keyfeature_section_status'))
    @include('frontend.partials.keyfeature.keyfeature-variant-01')
@endif
@if(get_static_option('home_page_why_choose_us_section_status'))
    @include('frontend.partials.why-choose-us-variant.why-choose-us-variant-'.get_static_option('why_choose_us_home_'.$home_variant_number.'_variant'))
@endif
@if(get_static_option('home_page_full_width_service_section_status'))
    @include('frontend.partials.full-width-service.full-width-service-variant-02')
@endif
@if(get_static_option('home_page_testimonial_section_status'))
    @include('frontend.partials.testimonial.testimonial-variant-02')
@endif
@if(get_static_option('home_page_latest_team_member_section_status'))
    @include('frontend.partials.team-member-area')
@endif
@if(get_static_option('home_page_price_plan_section_status'))
    @include('frontend.partials.price-plan-area')
@endif
@if(get_static_option('home_page_latest_blog_section_status'))
    @include('frontend.partials.blog-latest-area')
@endif
@if(get_static_option('home_page_call_to_action_section_status'))
    @include('frontend.partials.call-to-action-area')
@endif
