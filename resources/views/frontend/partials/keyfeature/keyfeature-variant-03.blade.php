<div class="header-bottom-area padding-bottom-120 padding-top-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-top-content margin-bottom-35">
                    <div class="section-title">
                        <h2 class="title">{{get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_title')}}</h2>
                        <p>{{get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_description')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="provide-single-list">
                    @foreach ($all_key_features as $key => $data)
                    <li class="provide-single-item style-0{{$key%2}}">
                        <div class="icon">
                            <i class="flaticon-vacuum"></i>
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
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>