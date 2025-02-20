<section class="why-choose-use-area padding-bottom-80">
    <div class="container">
        <div class="why-choose-use-area-wrapper m-top">
            <div class="row">
                @foreach ($all_why_choose_us as $key => $data)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="choose-single-item margin-bottom-30 bg-image">
                        <div class="icon bg-image" style="background-image: url(assets/frontend/important/choose/01.png);">
                            <i class="{{ $data->icon }}"></i>
                        </div>
                        <div class="content">
                            <a href="#">
                                <h4 class="title"><a href="{{route('frontend.services.single',[optional($data->lang_front)->slug ?? 'x',$data->id])}}">{{ optional($data->lang_front)->title }}</a></h4>
                                <span class="subtitle">{{ optional($data->category_front)->name }}</span>
                            </a>
                            <p>{{ optional($data->lang_front)->excerpt }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>