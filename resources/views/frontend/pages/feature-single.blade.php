@extends('frontend.frontend-page-master')
@section('site-title')
{{$feature->title}}
@endsection
@section('page-title')
{{$feature->title}}
@endsection
@section('content')
    <section class="padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-feature-details">
                        <div class="thumb">
                            {!! render_image_markup_by_attachment_id($feature->image) !!}
                        </div>
                        <div class="content-area">
                            <h2 class="title">{{$feature->title}}</h2>
                            <hr>
                            <div class="feature-description">
                                {!! $feature->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
