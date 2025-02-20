<section class="why-choose-use-area padding-top-110 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-sm-12 col-12">
                <div class="section-title desktop-center margin-bottom-55">
                    <div class="icon">
                        <span class="line-one"></span>
                        <span class="line-two"></span>
                        <i class="flaticon-paint-brush"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h2 class="title">{{get_static_option('home_page_why_choose_us_section_'.$user_select_lang_slug.'_title')}}</h2>
                    <p>{{get_static_option('home_page_why_choose_us_section_'.$user_select_lang_slug.'_description')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($all_why_choose_us as $key => $data)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="choose-single-item margin-bottom-30 bg-image @if($key == 1) active @endif">
                    <div class="icon bg-image" style="background-image: url({{asset('assets/frontend/important/choose/01.png')}});">
                        <i class="{{ $data->icon }}"></i>
                    </div>
                    <div class="content">
                        <h4 class="title"><a href="{{route('frontend.services.single',[$data->lang_front->slug ?? 'x',$data->id])}}">{{ optional($data->lang_front)->title }}</a></h4>
                        <p>{{ optional($data->lang_front)->excerpt }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>