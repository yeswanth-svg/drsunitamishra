<section class="creative-team-area @if(in_array(\Route::current()->getName(),['homepage','homepage.demo'])) padding-top-110 @endif padding-bottom-85 @if($home_variant_number == '02') bg-image bg-liteblue @endif" @if($home_variant_number == '02') {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_team_section_bg')) !!} @endif>
    <div class="container">
        <div class="row justify-content-center padding-bottom-45">
            <div class="col-lg-8">
                <div class="section-title desktop-center">
                    <div class="icon">
                        <span class="line-one"></span>
                        <span class="line-two"></span>
                        <i class="{{get_static_option('site_heading_icon')}}"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h2 class="title">{{get_static_option('home_page_team_section_'.$user_select_lang_slug.'_title')}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($all_team_members as $data)
            <div class="col-lg-3  col-sm-6">
                <div class="appointment-single-item">
                    <div class="thumb"
                            {!! render_background_image_markup_by_attachment_id($data->image,'','grid') !!}
                    >
                        <div class="cat">
                            <a href="{{route('frontend.appointment.category',['id' => $data->categories_id,'any' => Str::slug($data->category_front->name ?? __("Uncategorized"))])}}">{{optional($data->category_front)->name ?? __("Uncategorized")}}</a>
                        </div>
                    </div>
                    <div class="content">
                        <div class="top-part">
                            @if(!empty(optional($data->lang_front)->designation))
                                <span class="designation">{{optional($data->lang_front)->designation}}</span>
                            @endif
                            @if(count($data->reviews) > 0)
                                <div class="rating-wrap">
                                    <div class="ratings">
                                        <span class="hide-rating"></span>
                                        <span class="show-rating" style="width: {{{get_appointment_ratings_avg_by_id($data->id) / 5 * 100}}}%"></span>
                                    </div>
                                    <p><span class="total-ratings">({{count($data->reviews)}})</span></p>
                                </div>
                            @endif
                        </div>
                        <a href="{{route('frontend.appointment.single',['slug' => optional($data->lang_front)->slug, 'id' => $data->id])}}"><h4 class="title">{{optional($data->lang_front)->title}}</h4></a>
                        @if(!empty(optional($data->lang_front)->location))
                            <span class="location"><i class="fas fa-map-marker-alt"></i>{{optional($data->lang_front)->location}}</span>
                        @endif

                        <p>{{Str::words(strip_tags(optional($data->lang_front)->short_description),10)}}</p>
                        <div class="btn-wrapper">
                            <a href="{{route('frontend.appointment.single',['slug' => optional($data->lang_front)->slug ?? 'x', 'id' => $data->id])}}" class="boxed-btn">{{get_static_option('appointment_page_'.$user_select_lang_slug.'_booking_button_text')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>