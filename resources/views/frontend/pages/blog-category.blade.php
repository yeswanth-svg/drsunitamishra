@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Category:').' '.$category_name}}
@endsection
@section('site-title')
    {{$category_name}}
@endsection
@section('content')
    <section class="blog-content-area padding-120 ">
        <div class="container margin-bottom-120">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @if(count($all_blogs) < 1)
                            <div class="col-lg-12">
                                <div class="alert alert-warning alert-block col-md-12">
                                    <strong><div class="error-message"><span>{{__('No Post Available In :').' '.$category_name.' '.__('Category')}}</span></div></strong>
                                </div>
                            </div>
                        @endif
                        @foreach($all_blogs as $key => $data)
                        <div class="blog-classic-item-01 margin-bottom-60">
                            <div class="thumbnail">
                                {!! render_image_markup_by_attachment_id(optional($data->blog_front)->image) !!}
                                <div class="news-date">
                                    <h5 class="title">{{ date('d',strtotime(optional($data->blog_front)->created_at))}}</h5>
                                    <span>{{ date('M',strtotime(optional($data->blog_front)->created_at))}}</span>
                                </div>
                            </div>
                            <div class="content">
                                <ul class="post-meta">
                                    <li><i class="far fa-user"></i> {{ (optional($data->blog_front)->author) ?? __("Anonymous")}}</li>
                                    <li><i class="far fa-calendar-alt"></i> {{ optional(optional($data->blog_front)->created_at)->diffForHumans()}}</li>
                                </ul>
                                <h4 class="title"><a href="{{route('frontend.blog.single',['slug' => optional($data->blog_front)->slug ?? 'x','id' => $data->id])}}">{{ optional($data->blog_front)->title }}
                                </a></h4>
                                <p>{!! \Str::words(strip_tags(optional($data->blog_front)->content),52,'') !!}</p>
                                <div class="btn-wrapper">
                                    <a href="{{route('frontend.blog.single',['slug' => optional($data->blog_front)->slug ?? 'x', 'id' => $data->id])}}" class="boxed-btn">{{__('Read More')}}</a>
                                </div>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <nav class="pagination-wrapper" aria-label="Page navigation ">
                           {{$all_blogs->links()}}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                   @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
