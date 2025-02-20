<div class="progress-bar-area bg-image padding-bottom-295 padding-top-120" {!! render_background_image_markup_by_attachment_id(get_static_option('about_page_progressbar_section_bg')) !!}>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title margin-bottom-40">
                    <div class="icon">
                        <i class="{{get_static_option('site_heading_icon')}}"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h3 class="title">{{get_static_option('about_page_progressbar_section_'.$user_select_lang_slug.'_title')}}</h3>
                </div>
            </div>
            <div class="col-lg-6">
                <input type="number" id="count" value="{{count($all_progressbar)}}" hidden>
                <div class="progress-item-wrapper">
                    @foreach ($all_progressbar as $key=> $data)
                    <input type="number" id="progress-val-{{$key}}" value="{{$data->progress}}" hidden>
                    <div class="progress-item">
                        <div class="single-progressbar">
                            <h4 class="subtitle">{{$data->title}}</h4>
                            <div class="progress-{{$key}}"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
        (function($) {
            'use strict';
            var count = $("#count").val()
            for (var i = 0; i < count; i++) {
                var val = $("#progress-val-"+i).val()
                $(".progress-"+i).rProgressbar({
                percentage: val,
                fillBackgroundColor: '#14b3e4'
                });
            }
           
    })(jQuery);
</script>
@endsection