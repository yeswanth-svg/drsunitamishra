<div class="info-bar">
    <div class="info-bar-bottom bg-white style-02">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="info-bar-inner">
                        <div class="left-content-area">
                            <div class="logo-wrapper">
                                <a href="{{route('homepage')}}" class="logo">
                                    {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                                </a>
                            </div>
                        </div>
                        <div class="right-content-area style-01">
                            <div class="info-bottom-right">
                                <ul class="info-items-03">
                                    @foreach ($all_right_section_items as $item)
                                    @if($user_select_lang_slug == $item->lang)
                                        <li class="info-bar-item">
                                            <div class="icon">
                                                <i class="{{$item->icon}}"></i>
                                            </div>
                                            <div class="content">
                                                <span class="title">{{$item->title}}
                                            </span>
                                                <p class="details">{{$item->details}}</p>
                                            </div>
                                        </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>