@extends('backend.admin-master')
@section('site-title')
    {{__('Services Page Section Manage')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Services Page Section Manage')}}</h4>
                        <form action="{{route('admin.services.page.section.manage')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                                $section_names = ['services','keyfeature','counterup','team','brand','banner'];
                            @endphp
                            <div class="row">
                                @foreach($section_names as $section_name)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="services_page_{{$section_name}}_section_status"><strong>{{__(Str::ucfirst($section_name).' Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="services_page_{{$section_name}}_section_status"  @if(!empty(get_static_option('services_page_'.$section_name.'_section_status'))) checked @endif id="services_page_{{$section_name}}_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

