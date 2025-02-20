<div class="eco-friendly-area padding-top-180 padding-bottom-227">
    <div class="bg-img-01 bg-blue" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img')) !!}></div>
    <div class="bg-img-02 home" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img_right')) !!}></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="eco-content">
                    <div class="section-title white">
                        <div class="icon">
                            <i class="{{get_static_option('site_heading_icon')}}"></i>
                            <span class="line-three"></span>
                            <span class="line-four"></span>
                        </div>
                        <h3 class="title">{{get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_title')}}</h3>
                        <p>{{get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_description')}}</p>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach(explode("\n",get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_features')) as $item)
                                <li><i class="fas fa-check"></i> {{$item}}</li> 
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="we-available">
                    <p>{{get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_support_description')}}</p>
                    <div class="available-item">
                        <div class="icon">
                            <i class="{{get_static_option('home_page_full_width_service_section_support_icon')}}"></i>
                        </div>
                        <div class="content">
                            <span>{{get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_support_title')}}</span>
                            <p>{{get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_support_details')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>