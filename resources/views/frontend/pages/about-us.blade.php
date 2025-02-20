@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('about_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('about_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
<meta name="description" content="{{get_static_option('about_page_'.$user_select_lang_slug.'_meta_description')}}">
<meta name="tags" content="{{get_static_option('about_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
    @if(get_static_option('about_page_full_width_service_section_status'))<!--full-width-service-area -->
        @include('frontend.partials.full-width-service.full-width-service-variant-04')
    @endif
    @if(get_static_option('about_page_progress_bar_section_status'))
        @include('frontend.partials.progress-bar')
    @endif
    @if(get_static_option('about_page_why_choose_us_section_status'))
        @include('frontend.partials.why-choose-us-variant.why-choose-us-variant-05')
    @endif
    @if(get_static_option('about_page_team_member_section_status'))
        @include('frontend.partials.team-member-area')
    @endif
    @if(get_static_option('about_page_counterup_section_status'))
        @include('frontend.partials.counterup-about-area')
    @endif
@endsection
