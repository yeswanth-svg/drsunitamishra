<div class="header-bottom-area padding-bottom-90">
    <div class="container">
        <div class="header-bottom-wrapper m-top-02">
            <div class="row">
                <div class="col-lg-6">
                    <div class="provide-content">
                        <div class="section-title desktop-right">
                            <h2 class="title">{{get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_title')}}</h2>
                            <div class="btn-wrapper">
                                <a href="{{get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_btn_url')}}" class="boxed-btn">{{get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_btn_text')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        @foreach ($all_key_features as $key => $data)
                        @if($key<2)
                        <div class="col-lg-12 col-md-6">
                            <div class="provide-single-item style-0{{$key++}} margin-bottom-30">
                                <div class="icon">
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
                        @endif
                        @endforeach
                    </div>
                </div>
                @foreach ($all_key_features as $key => $data)
                @if($key == '2')
                <div class="col-lg-3 col-md-6">
                    <div class="provide-single-item style-02 margin-top-90 margin-bottom-30">
                        <div class="icon">
                            <i class="{{$data->icon}}"></i>
                        </div>
                        <div class="content">
                            <h4 class="title">{{$data->subtitle}}</h4>
                            <p>{{$data->title}}</p>
                            <ul>
                                @foreach(explode("\n",$data->features) as $key=> $item)
                                    @if(($key) < get_static_option('home_page_'.$home_variant_number.'_key_feature_number'))
                                    <li><i class="fas fa-check"></i> {{$item}}</li> 
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>