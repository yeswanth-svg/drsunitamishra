<div class="counterup-area bg-liteblue">
    <div class="container">
        <div class="counterup-wrapper">
            <div class="row">
                @foreach ($all_counterups as $data)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-counterup-01">
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