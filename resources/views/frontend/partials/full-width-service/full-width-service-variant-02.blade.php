<div class="eco-friendly-area bg-blue bg-image" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img')) !!}>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="eco-content padding-top-110 padding-bottom-110">
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
            <div class="col-lg-6">
                <div class="eco-friendly-img bg-image" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img_right')) !!}>
                </div>
            </div>
        </div>
    </div>
</div>