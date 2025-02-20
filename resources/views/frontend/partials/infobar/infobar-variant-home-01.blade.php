<div class="info-bar">
    <div class="info-bar-bottom style-01">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="info-bar-inner">
                        <div class="left-content-area">
                            <div class="social-link">
                                <ul>
                                    @foreach ($all_social_icons as $item)
                                        <li><a href="{{ $item->url }}" target="_blank"><i class="{{ $item->icon }}"></i></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="right-content-area">
                            <div class="info-bottom-right">
                                <ul class="info-items-02">
                                    <li> 
                                        <h4 class="title">{{ get_static_option('home_page_infobar_section_'.$user_select_lang_slug.'_title') }}</h4>
                                        <a href="{{ get_static_option('home_page_infobar_section_'.$user_select_lang_slug.'_url') }}"> <span class="number">{{ get_static_option('home_page_infobar_section_'.$user_select_lang_slug.'_details') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>