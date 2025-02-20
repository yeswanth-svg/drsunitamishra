@extends('frontend.frontend-page-master')
@section('page-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}} {{__('Category:')}} {{$category_name}}
@endsection
@section('site-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}} {{__('Category:')}} {{$category_name}}
@endsection
@section('content')
    <section class="blog-content-area padding-100">
        <div class="container">
            <div class="row">
                @if(count($service_items) == '0')   
                    <div class="col-lg-12">
                        <div class="alert alert-danger">{{__('No Post Available In This Category')}}</div>
                    </div>
                @endif
                @foreach($service_items as $data)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="cleaning-single-item margin-bottom-30">
                                <div class="thumb">
                                    {!! render_image_markup_by_attachment_id($data->image) !!}
                                </div>
                                <div class="icon">
                                    <i class="{{$data->icon}}"></i>
                                </div>
                                <div class="content">
                                    <a href="{{route('frontend.services.single',['slug'=>$data->lang->slug,'id'=>$data->id])}}"><h4 class="title">{{optional($data->lang_front)->title}}</h4></a>
                                    <a href="{{route('frontend.services.single',['slug'=>$data->lang->slug,'id'=>$data->id])}}"><p>{{optional($data->lang_front)->excerpt}}</p></a>
                                </div>
                            </div>
                        </div>
                @endforeach
                <nav class="pagination-wrapper" aria-label="Page navigation">
                    {{$service_items->links()}}
                </nav>
            </div>
        </div>
    </section>
@endsection
