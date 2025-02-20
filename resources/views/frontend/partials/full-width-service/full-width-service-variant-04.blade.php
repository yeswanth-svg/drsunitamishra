<div class="eco-friendly-area margin-top-120 margin-bottom-120">
    <div class="container">
        <div class="eco-friendly-area-wrapper padding-top-60 padding-bottom-60">
            <div class="bg-img-02 about" {!! render_background_image_markup_by_attachment_id(get_static_option('about_page_full_width_service_section_bg_img_right')) !!}></div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="eco-content bg-white style-01">
                        <div class="section-title">
                            <div class="icon">
                                <i class="{{get_static_option('site_heading_icon')}}"></i>
                                <span class="line-three"></span>
                                <span class="line-four"></span>
                            </div>
                            <h3 class="title">{{get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_title')}}</h3>
                            <p>{{get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_description')}}</p>
                        </div>
                        <div class="content style-01">
                            <ul>
                                @foreach(explode("\n",get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_features')) as $item)
                                    <li><i class="fas fa-check"></i> {{$item}}</li> 
                                @endforeach
                            </ul>
                            <div class="available-item style-01">
                                <div class="icon">
                                    <i class="{{get_static_option('about_page_full_width_service_section_support_icon')}}"></i>
                                </div>
                                <div class="content">
                                    <span>{{get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_support_title')}}</span>
                                    <p>{{get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_support_details')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>