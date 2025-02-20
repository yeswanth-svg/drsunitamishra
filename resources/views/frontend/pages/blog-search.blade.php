@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Search For: ').$search_term}}
@endsection
@section('site-title')
    {{__('Blog Search')}}
@endsection
@section('content')
<div class="page-content our-attoryney padding-top-120 padding-bottom-20">
    <div class="container margin-bottom-120">
        <div class="row">
            <div class="col-lg-8">
                @if(count($all_blogs) < 1)
                <div class="col-lg-12">
                    <div class="alert alert-warning alert-block col-md-12">
                        <strong><div class="error-message"><span>{{__('Nothing found related to : ').$search_term}}</span></div></strong>
                    </div>
                </div>
                @endif
                @foreach($all_blogs as $key => $data)
                        <div class="blog-classic-item-01 margin-bottom-60">
                            <div class="thumbnail">
                                {!! render_image_markup_by_attachment_id($data->image) !!}
                                <div class="news-date">
                                    <h5 class="title">{{ date('d',strtotime($data->created_at))}}</h5>
                                    <span>{{ date('M',strtotime($data->created_at))}}</span>
                                </div>
                            </div>
                            <div class="content">
                                <ul class="post-meta">
                                    <li><i class="far fa-user"></i> {{ ($data->author) ?? __("Anonymous")}}</li>
                                    <li><i class="far fa-calendar-alt"></i> {{ $data->created_at->diffForHumans()}}</li>
                                </ul>
                                <h4 class="title"><a href="{{route('frontend.blog.single',['slug' => $data->slug,'id' => $data->id])}}">{{ $data->title }}
                                </a></h4>
                                <p>{!! \Str::words(strip_tags($data->content),52,'') !!}</p>
                                <div class="btn-wrapper">
                                    <a href="{{route('frontend.blog.single',['slug' => $data->slug, 'id' => $data->id])}}" class="boxed-btn">{{__('Read More')}}</a>
                                </div>
                            </div>
                        </div> 
                @endforeach
                <div class="blog-pagination desktop-center">
                        {{$all_blogs->links()}}
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="widget-area">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
