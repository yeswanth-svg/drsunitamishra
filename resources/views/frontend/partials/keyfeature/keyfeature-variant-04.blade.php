<div class="header-bottom-area bg-blue-03 bg-image padding-bottom-80" {!! render_background_image_markup_by_attachment_id(get_static_option('home_page_keyfeatures_section_'.$home_variant_number.'_bg_img')) !!}>
    <div class="container">
        <div class="header-bottom-wrapper m-top bg-white">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-wrapper">
                        <div class="left-content bg-blue">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach ($all_key_features as $key => $data)
                                <li class="nav-item">
                                    <a class="nav-link @if($key == 0) active @endif service-item-list show" id="{{\Str::slug($data->subtitle)}}-tab" data-toggle="tab" href="#{{\Str::slug($data->subtitle)}}" role="tab" aria-controls="{{\Str::slug($data->subtitle)}}" aria-selected="true">
                                        <div class="service-icon style-01">
                                            <i class="{{ $data->icon }}"></i>
                                        </div>
                                        <div class="service-title">
                                            <h4 class="title">{{ $data->subtitle }}</h4>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="right-content">
                            <div class="tab-content" id="myTabContent">
                                @foreach ($all_key_features as $key => $data)
                                <div class="tab-pane fade @if($key == 0) active show @endif" id="{{\Str::slug($data->subtitle)}}" role="tabpanel" aria-labelledby="{{\Str::slug($data->subtitle)}}-tab">
                                    <div class="description-tab-content">
                                        <div class="text-content-tab">
                                            <div class="section-title">
                                                <span class="subtitle">{{$data->subtitle}}</span>
                                                <h3 class="title">{{$data->title}}</h3>
                                                <p>{!! $data->description !!}</p> 
                                            </div>
                                            <div class="content">
                                                <ul>
                                                    <div class="row">
                                                        @foreach(explode("\n",$data->features) as $key => $item)
                                                        <div class="col-md-6">
                                                            <li><i class="fas fa-check"></i> {{$item}}</li> 
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="serivce-bg" {!! render_background_image_markup_by_attachment_id($data->image) !!}></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>