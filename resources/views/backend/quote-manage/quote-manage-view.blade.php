@extends('backend.admin-master')
@section('site-title')
    {{__('Quote Details')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between margin-bottom-40">
                           <h4 class="header-title">{{__('Quote Details')}}</h4>
                           <a href="{{route('admin.quote.manage.all')}}" class="btn btn-info">{{__('All Quotes')}}</a>
                       </div>
                        <div class="booking-details-info">
                            <ul>
                                <li><strong>{{__('ID')}}</strong> : #{{$quote->id}}</li>
                                <li><strong>{{__('Status')}}</strong> : {{$quote->status}}</li>
                                @php
                                    $custom_fields = unserialize($quote->custom_fields,['class'=>false]) ?? [];
                                    $all_attachment = unserialize($quote->all_attachment,['class'=>false]) ?? [];
                                @endphp
                                @if($custom_fields)
                                <li><strong>{{__('Custom Fields')}}</strong> :
                                    <ul>
                                        @foreach($custom_fields as $key => $item)
                                            @if(in_array($key,['captcha_token']))
                                                @continue
                                            @endif
                                            <li><string>{{str_replace(['_','-'],[' ',' '],$key)}}</string> : {{htmlspecialchars(strip_tags($item))}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                @if($all_attachment))
                                    <li><strong>{{__('Attachments')}}</strong> :
                                        <ul>
                                            @foreach($all_attachment as $key => $item)
                                                <li><string>{{str_replace(['_','-'],[' ',' '],$key)}}</string> :
                                                    <a href="{{asset($item)}}">{{$item}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
