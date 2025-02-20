@extends('backend.admin-master')
@section('site-title')
    {{__('Team Member Section')}}
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
                        <h4 class="header-title">{{__('Team Member Section Settings')}}</h4>
                        <form action="{{route('admin.services.team.member')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="services_page_{{$lang}}_team_member_section_title">{{__('Title')}}</label>
                                            <input type="text" name="services_page_{{$lang->slug}}_team_member_section_title" value="{{get_static_option('services_page_'.$lang->slug.'_team_member_section_title')}}" class="form-control" id="services_page_{{$lang->slug}}_team_member_section_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="services_page_{{$lang}}_team_member_section_subtitle">{{__('Sub Title')}}</label>
                                            <input type="text" name="services_page_{{$lang->slug}}_team_member_section_subtitle" value="{{get_static_option('services_page_'.$lang->slug.'_team_member_section_subtitle')}}" class="form-control" id="services_page_{{$lang->slug}}_team_member_section_subtitle">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="services_page_team_member_item">{{__('Team Member Item')}}</label>
                                <input type="number" name="services_page_team_member_item" value="{{get_static_option('services_page_team_member_item')}}" class="form-control" id="services_page_team_member_item">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
