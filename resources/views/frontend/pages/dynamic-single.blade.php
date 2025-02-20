@extends('frontend.frontend-page-master')
@section('site-title')
    {{$page_post->lang_front->meta_title ?? $page_post->lang_front->title}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$page_post->lang_front->meta_description}}">
    <meta name="tags" content="{{$page_post->lang_front->meta_tags}}">
    <meta name="og:title" content="{{$page_post->lang_front->og_meta_title}}"/>
    <meta name="og:description" content="{{$page_post->lang_front->og_meta_description}}"/>
    <meta name="og:site_name" content="{{get_static_option('og_meta_'.$user_select_lang_slug.'_site_name')}}"/>
    <meta name="og:url" content="{{route('frontend.dynamic.page',[$page_post->lang_front->slug,$page_post->id])}}"/>
    {!! render_og_meta_image_by_attachment_id($page_post->lang_front->og_meta_image) !!}
@endsection
@section('page-title')
    {{$page_post->lang_front->title}}
@endsection
@section('content')
    <section class="dynamic-page-content-area padding-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dynamic-page-content-wrap">
                        {!! $page_post->lang_front->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
