@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
<section class="cleaning-company-area bg-white padding-top-110 padding-bottom-85">
    <div class="container">
        <div class="row">
            @foreach($all_services as $data)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="cleaning-single-item margin-bottom-30">
                    <div class="thumb">
                        {!! render_image_markup_by_attachment_id($data->image) !!}
                    </div>
                    <div class="icon">
                        <i class="{{$data->icon}}"></i>
                    </div>
                    <div class="content">
                        <a href="{{route('frontend.services.single',['slug'=>$data->lang->slug ?? 'x','id'=>$data->id])}}"><h4 class="title">{{optional($data->lang_front)->title}}</h4></a>
                        <a href="{{route('frontend.services.single',['slug'=>$data->lang->slug ?? 'x','id'=>$data->id])}}"><p>{{optional($data->lang_front)->excerpt}}</p></a>
                    </div>
                </div>
            </div>
            @endforeach 
            <div class="col-lg-12">
                <div class="pagination-wrapper">
                    {{$all_services->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
