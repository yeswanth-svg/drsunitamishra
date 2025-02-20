<div class="counterup-area @if($home_variant_number == '03') bg-image bg-blue-03" {!! render_background_image_markup_by_attachment_id(get_static_option('counterup_bg_img')) !!}> @elseif($home_variant_number == '04') bg-liteblue "> @else "> @endif
    <div class="container">
        <div class="counterup-wrapper @if($home_variant_number == '01')m-top bg-liteblue @endif">
            <div class="row">
                @foreach ($all_counterups as $data)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-counterup-01 @if($home_variant_number == '03') style-01 @endif">
                            <div class="icon">
                                <i class="{{ $data->icon}}"></i>
                            </div>
                            <div class="content">
                                <div class="count-wrap"><span class="count-num">{{ $data->number}}</span>{{ $data->extra_text}}</div>
                                <h4 class="title">{{ $data->title}}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>