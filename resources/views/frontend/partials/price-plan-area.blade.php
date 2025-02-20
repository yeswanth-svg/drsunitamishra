<div class="price-plan-area {{($home_variant_number == '04')? 'bg-white':'bg-blue'}} padding-top-110 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title {{($home_variant_number == '04')? '':'white'}}  extra desktop-center margin-bottom-55">
                    <div class="icon">
                        <span class="line-one"></span>
                        <span class="line-two"></span>
                        <i class="{{ get_static_option('site_heading_icon') }}"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h3 class="title">{{get_static_option('home_page_price_plan_section_'.$user_select_lang_slug.'_title')}}</h3>
                    <p>{{get_static_option('home_page_price_plan_section_'.$user_select_lang_slug.'_description')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($all_price_plans as $key => $data)
            <div class="col-lg-4 col-md-6">
                <div class="single-price-plan-01 {{($key == 1)? 'active' : ''}}">
                    <div class="price-header">
                        <div class="img-icon">
                            {!! render_image_markup_by_attachment_id($data->image) !!}
                        </div>
                        <h4 class="title">{{optional($data->lang_front)->title}}</h4>
                    </div>
                    <div class="price-body">
                        <ul>
                            @foreach(explode("\n",optional($data->lang_front)->features) as $item)
                                <li><i class="fa fa-check success"></i> {{$item}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="price-wrap">
                        {!! custom_amount_with_currency_symbol($data->price) !!} <span class="sign">{{ $data->type }}</span>
                    </div>
                    <div class="price-footer">
                        <div class="btn-wrapper">
                            <a href="{{ ($data->btn_url)?? route('frontend.plan.order',['id' => $data->id]) }}" class="boxed-btn">{{optional($data->lang_front)->btn_text}}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>