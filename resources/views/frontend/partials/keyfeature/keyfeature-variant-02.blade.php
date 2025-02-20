<div class="header-bottom-area padding-bottom-90">
    <div class="container">
        <div class="header-bottom-wrapper m-top-03">
            <div class="row">
                @foreach ($all_key_features as $key => $data)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="provide-single-item style-03 margin-bottom-30">
                        <div class="icon style-0{{$key++}}">
                            <i class="{{$data->icon}}"></i>
                        </div>
                        <div class="content">
                            <h4 class="title">{{$data->subtitle}}</h4>
                            <p>{{$data->title}}</p>
                            <ul>
                                @foreach(explode("\n",$data->features) as $key => $item)
                                @if(($key) < get_static_option('home_page_'.$home_variant_number.'_key_feature_number'))
                                <li><i class="fas fa-check"></i> {{$item}}</li> 
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-4">
                    <div class="request-page-form-wrap style-01">
                        <div class="section-title">
                            <h4 class="title">{{get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_quote_title')}}</h4>
                            <p>{{get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_quote_subtitle')}}</p>
                        </div>
                        @include('frontend.partials.quote-form.quote-form-render')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>