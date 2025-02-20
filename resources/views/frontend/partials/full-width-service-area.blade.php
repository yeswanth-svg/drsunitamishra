@if($home_variant_number == '01')
@php $class_name = "col-lg-4"; @endphp
<div class="eco-friendly-area padding-top-180 padding-bottom-227">
    <div class="bg-img-01 bg-blue" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img')) !!}></div>
    <div class="bg-img-02" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img_right')) !!}></div>
@elseif($home_variant_number == '04')
    @php $class_name = "col-lg-6"; $var = 04 @endphp
    <div class="eco-friendly-area padding-top-120 padding-bottom-120">
    <div class="bg-img-02" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img_right')) !!}></div>
@else
@php $class_name = "col-lg-6"; @endphp
    <div class="eco-friendly-area bg-blue bg-image" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img')) !!}>
@endif
    <div class="container">
        <div class="row">
            <div class="{{$class_name}}">
                <div class="eco-content @if($home_variant_number == '02')padding-top-110 padding-bottom-110 @elseif($home_variant_number == '04') bg-white style-01 @endif">
                    <div class="section-title @if($home_variant_number != '04') white @endif">
                        <div class="icon">
                            <i class="{{get_static_option('site_heading_icon')}}"></i>
                            <span class="line-three"></span>
                            <span class="line-four"></span>
                        </div>
                        <h3 class="title">{{get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_title')}}</h3>
                        <p>{{get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_description')}}</p>
                    </div>
                    <div class="content @if(isset($var)) style-01 @endif">
                        <ul>
                            @foreach(explode("\n",get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_features')) as $item)
                                <li><i class="fas fa-check"></i> {{$item}}</li> 
                            @endforeach
                        </ul>
                        @if(isset($var))
                        <div class="available-item style-01">
                            <div class="icon">
                                <i class="{{get_static_option('home_page_full_width_service_section_support_icon')}}"></i>
                            </div>
                            <div class="content">
                                <span>{{get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_support_title')}}</span>
                                <p>{{get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_support_details')}}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
                @if(!isset($var))
                <div class="{{$class_name}}">
                    @if($home_variant_number == '01')
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
                    @else
                    <div class="eco-friendly-img bg-image" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img_right')) !!}></div>
                    @endif
                </div>
                @endif
        </div>
    </div>
</div>