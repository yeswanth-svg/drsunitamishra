<section class="blog-area padding-top-110 padding-bottom-100 bg-liteblue">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-title-content margin-bottom-45">
                    <div class="section-title">
                        <div class="icon">
                            <i class="{{get_static_option('site_heading_icon')}}"></i>
                            <span class="line-three"></span>
                            <span class="line-four"></span>
                        </div>
                        <h3 class="title">{{get_static_option('home_page_latest_blog_section_'.$user_select_lang_slug.'_title')}}</h3>
                    </div>
                    <div class="btn-wrapper">
                        <a href="{{route('frontend.blog')}}" class="boxed-btn">{{get_static_option('home_page_latest_blog_section_'.$user_select_lang_slug.'_subtitle')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($all_recent_blogs as $data)
            <div class="col-md-6 col-lg-4">
                <div class="single-blog-grid-01 margin-bottom-30">
                    <div class="thumb">
                        {!! render_image_markup_by_attachment_id(optional($data->blog_front)->image) !!}
                        <div class="news-date">
                            <h5 class="title">{{ date('d',strtotime(optional($data->blog_front)->created_at))}}</h5>
                             <span>{{ date('M',strtotime(optional($data->blog_front)->created_at))}}</span>
                        </div>
                    </div>
                    <div class="content">
                        <ul class="post-meta">
                            <li><i class="far fa-user"></i> {{ optional($data->blog_front)->author ?? __("Anonymous")}}</li>
                            <li><i class="far fa-calendar-alt"></i> {{ optional(optional($data->blog_front)->created_at)->diffForHumans()}}</li>
                        </ul>
                        <h4 class="title"><a href="{{route('frontend.blog.single',['slug' => optional($data->blog_front)->slug ?? 'x', 'id' => $data->id])}}">{{ optional($data->blog_front)->title }}</a></h4>
                        <p>{!! \Str::words(strip_tags(optional($data->blog_front)->content),20,'') !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>