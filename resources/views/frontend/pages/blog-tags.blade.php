@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Tags:')}} {{' '.$tag_name}}
@endsection
@section('site-title')
{{ ucfirst($tag_name)}}
@endsection
@section('content')
<section class="blog-content-area padding-120 ">
    <div class="container margin-bottom-120">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @if(count($all_blogs) < 1)
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                {{__('Nothing found')}}
                            </div>
                        </div>
                    @endif
                    @if(count($all_blogs) < 1)
                            <div class="col-lg-12">
                                <div class="alert alert-warning alert-block col-md-12">
                                    <strong><div class="error-message"><span>{{__('No Post Available In :').' '.$tag_name.__('Tag')}}</span></div></strong>
                                </div>
                            </div>
                        @endif
                    @foreach($all_blogs as $data)
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
                                <h4 class="title"><a href="{{route('frontend.blog.single',['slug' => $data->slug,'id' => $data->blog_id])}}">{{ $data->title }}
                                </a></h4>
                                <p>{!! \Str::words(strip_tags($data->content),52,'') !!}</p>
                                <div class="btn-wrapper">
                                    <a href="{{route('frontend.blog.single',['slug' => $data->slug, 'id' => $data->blog_id])}}" class="boxed-btn">{{__('Read More')}}</a>
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
            <div class="col-lg-4 mb-5">
                <div class="widget-area">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
