@extends('user.layouts.app')
@section('title', 'Sách Hay - ' . \App\Models\Option::getvalue('sitename'))
@section('seo')
    <meta name="description" content="{{\App\Models\Option::getvalue('description')}}">
    <meta name="keywords" content="{{\App\Models\Option::getvalue('keyword')}}">
@endsection
@section('breadcrumb')
    {!! showBreadcrumb() !!}
@endsection
@section('content')

    <div class="container visible-md-block visible-lg-block" id="intro-index">
        <div class="title-list">
            <h2><a href="" title="Sách hot">Sách hot <span class="glyphicon glyphicon-fire"></span></a></h2>
            <select id="hot-select" class="form-control new-select">
                <option value="all">Tất cả</option>
                {{ category_parent(\App\Models\Category::get()) }}
            </select>
        </div>
        <div class="index-intro">
            {!! \App\Models\Story::getListHotStories() !!}
        </div>
    </div>

    <div class="container" id="list-index">
        {{--@include('user.partials.reading')--}}
        <div class="list list-truyen list-new col-xs-12 col-sm-12 col-md-8 col-truyen-main">
            <div class="title-list">
                <h2><a href="" title="Sách mới">Sách mới <span class="glyphicon glyphicon-menu-right"></span></a></h2>
                <select id="new-select" class="form-control new-select">
                    <option value="all">Tất cả</option>
                    {{ category_parent(\App\Models\Category::get()) }}
                </select>
            </div>
            {!!  \App\Models\Story::getListNewStories()  !!}
        </div>

        {{--Sidebar--}}
        <div class="visible-md-block visible-lg-block col-md-4 text-center col-truyen-side">
            @include('user.widgets.categories')
            @include('user.widgets.ads')
        </div>
    </div>

    {!!  \App\Models\Story::getListDoneStories()  !!}
@endsection

