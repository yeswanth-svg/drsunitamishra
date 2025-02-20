<nav class="navbar navbar-area navbar-expand-lg has-topbar-02 nav-style-02">
    <div class="container nav-container cleaning-left">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper mobile-logo">
                <a href="{{ route('homepage')}}" class="logo">
                    {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                </a>
            </div>
            <div class="mobile-cart"><a href="{{route('frontend.products.cart')}}"><i class="{{get_static_option('shopping_cart_icon')}}"></i> <span class="pcount">0</span></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
            <ul class="navbar-nav">
                {!! render_menu_by_id($primary_menu) !!}
            </ul>
        </div>
        <div class="nav-right-content">
            <div class="icon-part nav-style-04">
                <ul>
                    <li class="cart"><a href="{{route('frontend.products.cart')}}"><i class="{{get_static_option('shopping_cart_icon')}}"></i> <span class="pcount">{{cart_total_items()}}</span></a></li>
                </ul>
            </div>
            <div class="btn-wrapper">
                @php
                    $button_url = get_static_option('navbar_button_url_'.$user_select_lang_slug) ?? route('frontend.quote');
                @endphp
                <a href="{{$button_url}}" class="request-btn style-01">{{get_static_option('navbar_button_text_'.$user_select_lang_slug)}}<i class="{{get_static_option('navbar_button_icon')}}"></i></a>
            </div>
        </div>
    </div>
</nav>