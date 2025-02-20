@extends('frontend.frontend-page-master')
@section('site-title')
    {{optional($blog_post->lang_front)->meta_title}}
@endsection
@section('page-title')
    {{optional($blog_post->lang_front)->title}}   
@endsection
@section('page-meta-data')
<meta name="title" content="{{optional($blog_post->lang_front)->meta_title}}">
<meta name="tags" content="{{optional($blog_post->lang_front)->meta_tags}} ">
<meta name="description" content="{{optional($blog_post->lang_front)->meta_description}}">
@endsection
@section('og-meta')
<meta name="og:title" content="{{optional($blog_post->lang_front)->og_meta_title}}">
<meta name="og:description" content="{{optional($blog_post->lang_front)->og_meta_description}}">
{!! render_og_meta_image_by_attachment_id(optional($blog_post->lang_front)->og_meta_image) !!}
<meta name="og:tags" content=" {{optional($blog_post->lang_front)->meta_tags}}">

@endsection
@section('content')
        <!-- Blog Details Area -->
        <div class="page-content our-attoryney padding-bottom-20 padding-top-120">
            <div class="container margin-bottom-120">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-details-item">
                            <div class="thumb margin-bottom-20">
                                @php $post_img = null; @endphp
                                {!! render_image_markup_by_attachment_id(optional($blog_post->lang_front)->image) !!}
                                <div class="news-date">
                                    <h5 class="title">{{ date('d',strtotime(optional($blog_post->lang_front)->created_at))}}</h5>
                                    <span>{{ date('M',strtotime(optional($blog_post->lang_front)->created_at))}}</span>
                                </div>
                            </div>
                            <div class="blog-details-item-header">
                                <ul class="post-meta">
                                    <li><i class="far fa-user"></i> {{ (optional($blog_post->lang_front)->author) ?? __("Anonymous")}}</li>
                                    <li><i class="far fa-calendar-alt"></i> {{ optional(optional($blog_post->lang_front)->created_at)->diffForHumans()}}</li>
                                </ul>
                            </div>
                            <h2 class="title">{{Purifier::clean(optional($blog_post->lang_front)->title)}}</h2>
                           <p>{!! \Mews\Purifier\Facades\Purifier::clean(optional($blog_post->lang_front)->content) !!}</p>
                        </div>
                        <div class="blog-details-footer">
                            <div class="left">
                                <ul class="tags">
                                    <li class="title">{{__('Tags: ')}}</li>
                                    @php
                                        $all_tags = explode(',',optional($blog_post->lang_front)->tags);
                                    @endphp
                                    @foreach($all_tags as $tag)
                                        @php 
                                        $slug = Str::slug($tag);
                                        @endphp 
                                        @if (!empty($slug))
                                            <li><a href="{{route('frontend.blog.tags.page',['name' => $slug])}}">{{$tag}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="right">
                                <div class="social-link style-02">
                                     <ul>
                                        <li class="title"><i class="fas fa-share-alt"></i>{{__('Share:')}}</li>
                                     {!! \Mews\Purifier\Facades\Purifier::clean(single_post_share(route('frontend.blog.single',['id' => $blog_post->id, 'any' => Str::slug(optional($blog_post->lang_front)->title ?? 'x','-')]),optional($blog_post->lang_front)->title,$post_img)) !!}
                                    </ul>  
                                </div>
                            </div>
                        </div>
                        <div class="comments-area">
                            <div id="disqus_thread"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class="widget-area">
                           {{-- @include('frontend.partials.sidebar')--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
    <script>
        var disqus_config = function () {
        this.page.url = "{{route('frontend.blog.single',['id' => $blog_post->id, 'any' => Str::slug(strip_tags(Purifier::clean($blog_post->title)),'-')])}}";
        this.page.identifier = "{{$blog_post->id}}";
        };

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = "https://{{get_static_option('site_disqus_key')}}.disqus.com/embed.js";
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>{{__('Please enable JavaScript to view the')}} <a href="https://disqus.com/?ref_noscript">{{__('comments powered by Disqus.')}}</a></noscript>
@endsection
