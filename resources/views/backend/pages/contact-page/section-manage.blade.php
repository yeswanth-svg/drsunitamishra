@extends('backend.admin-master')
@section('site-title')
    {{__('Contact Page Section Manage')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Contact Page Section Manage')}}</h4>
                        <form action="{{route('admin.contact.page.section.manage')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                                $section_names = ['contact','map'];
                            @endphp
                            <div class="row">
                                @foreach($section_names as $section_name)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="contact_page_{{$section_name}}_section_status"><strong>{{__(Str::ucfirst(str_replace('_',' ',$section_name)).' Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="contact_page_{{$section_name}}_section_status"  @if(!empty(get_static_option('contact_page_'.$section_name.'_section_status'))) checked @endif id="contact_page_{{$section_name}}_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-btn.update/>
        });
        })(jQuery);
    </script>
@endsection