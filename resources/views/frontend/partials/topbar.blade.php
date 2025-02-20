<div class="topbar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="topbar-inner">
                    <div class="left-contnet">
                        <ul class="info-items">
                            @foreach ($all_topbar_infos as $item)
                                @if($user_select_lang_slug == $item->lang)
                                    <li><i class="{{$item->icon}}"></i> {{$item->details}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="right-contnet">
                        <ul class="info-items">
                            @if(auth()->check())
                                @php $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home'); @endphp
                                <li><a href="{{ $route }}">{{ __('Dashboard') }}</a> </li>
                                <li>/</li>
                                 <li>
                                    <a href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                    jQuery('#userlogout-form-submit-btn').trigger('click');">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                        <input type="submit" value="dd" id="userlogout-form-submit-btn" class="d- none">
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ route('user.login') }}">{{ __('Login') }}</a></li> 
                                <li>/</li>
                                <li><a href="{{ route('user.register') }}">{{ __('Register') }}</a></li>
                            @endif
                            @if (!empty(get_static_option('language_select_option')))
                                <div class="language_dropdown" id="languages_selector">
                                    <div class="selected-language">{{ get_language_name_by_slug(get_user_lang()) }} <i
                                            class="fas fa-caret-down"></i></div>
                                    <ul>
                                        @foreach ($all_language as $lang)
                                            <li data-value="{{ $lang->slug }}">{{ $lang->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>