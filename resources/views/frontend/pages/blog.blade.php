@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('blog_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('blog_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
<meta name="description" content="{{get_static_option('blog_page_'.$user_select_lang_slug.'_meta_description')}}">
<meta name="tags" content="{{get_static_option('blog_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
<div class="page-content our-attoryney padding-top-120 padding-bottom-10">
    <div class="container margin-bottom-120">
        <div class="row">
            @if(count($all_blogs) < 1)
                <div class="col-lg-8">
                    <div class="alert alert-warning alert-block col-md-12">
                        <strong><div class="error-message"><span>{{__('No posts available')}}</span></div></strong>
                    </div>
                </div>
            @endif
            <div class="col-lg-8">
                @foreach($all_blogs as $key => $data)
                        <div class="blog-classic-item-01 margin-bottom-60">
                            <div class="thumbnail">
                                {!! render_image_markup_by_attachment_id(optional($data->lang_front)->image) !!}
                                <div class="news-date">
                                    <h5 class="title">{{ date('d',strtotime(optional($data->lang_front)->created_at))}}</h5>
                                    <span>{{ date('M',strtotime(optional($data->lang_front)->created_at))}}</span>
                                </div>
                            </div>
                            <div class="content">
                                <ul class="post-meta">
                                    <li><i class="far fa-user"></i> {{ (optional($data->lang_front)->author) ?? __("Anonymous")}}</li>
                                    <li><i class="far fa-calendar-alt"></i> {{ optional(optional($data->lang_front)->created_at)->diffForHumans()}}</li>
                                </ul>
                                <h4 class="title"><a href="{{route('frontend.blog.single',['slug' => optional($data->lang_front)->slug ?? 'x', 'id' => $data->id])}}">{{ optional($data->lang_front)->title }}
                                </a></h4>
                                
                                <div class="btn-wrapper">
                                    <a href="{{route('frontend.blog.single',['slug' => optional($data->lang_front)->slug ?? 'x', 'id' => $data->id])}}" class="boxed-btn">{{__('Read More')}}</a>
                                </div>
                            </div>
                        </div> 
                @endforeach
                <div class="blog-pagination desktop-center">
                        {{$all_blogs->links()}}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget-area">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
