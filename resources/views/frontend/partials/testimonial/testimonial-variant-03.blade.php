<div class="contact-area bg-image-02 padding-top-120 padding-bottom-120" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_quote_bg_image')) !!}>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="row padding-bottom-50">
                    <div class="col-lg-8">
                        <div class="section-title white">
                            <div class="icon">
                                <i class="{{ get_static_option('site_heading_icon') }}"></i>
                                <span class="line-three"></span>
                                <span class="line-four"></span>
                            </div>
                            <h2 class="title">{{get_static_option('home_page_testimonial_section_'.$user_select_lang_slug.'_title')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="testimonial-carousel-area">
                    <div class="testimonial-carousel-02">
                        @foreach ($all_testimonials as $data)
                        <div class="single-testimonial-item style-01">
                            <div class="thumb bg-image" {!! render_background_image_markup_by_attachment_id($data->image) !!}></div>
                            <div class="content">
                                <div class="icon">
                                    <i class="flaticon-quote-left"></i>
                                </div>
                                <p class="description">{{ $data->description }} </p>
                                <div class="author-details">
                                    <div class="author-meta">
                                        <div class="ratings">
                                            @for($i=0; $i<$data->rating_star; $i++)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                        <h4 class="title"> - {{ $data->name }} </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="request-page-form-wrap">
                    <div class="section-title bg-image" style="background-image: url(assets/frontend/img/contact/02.png);">
                        <h4 class="title">{{get_static_option('home_page_quote_section_'.$user_select_lang_slug.'_title')}}</h4>
                        <p>{{get_static_option('home_page_quote_section_'.$user_select_lang_slug.'_details')}}</p>
                    </div>
                    @include('frontend.partials.quote-form.quote-form-render')
                </div>
            </div>
        </div>
    </div>
</div>