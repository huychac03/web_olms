@extends('layouts.app')
@section('title', 'TopTit.COM - ' . \App\Option::getvalue('sitename'))
@section('seo')
    <meta name="description" content="{{\App\Option::getvalue('description')}}">
    <meta name="keywords" content="{{\App\Option::getvalue('keyword')}}">
@endsection
@section('breadcrumb', showBreadcrumb())
@section('content')

    <div class="container visible-md-block visible-lg-block" id="intro-index">
        <div class="title-list">
            <h2><a href="{{route('danhsach.truyenhot')}}" title="Truyện hot">Sách hot <span class="glyphicon glyphicon-fire"></span></a></h2>
            <select id="hot-select" class="form-control new-select">
                <option value="all">Tất cả</option>
                {{ category_parent(\App\Category::get()) }}
            </select>
        </div>
        <div class="index-intro">
            {!! \App\Story::getListHotStories() !!}
        </div>
    </div>

    <div class="container" id="list-index">
      @include('partials.reading')
        <div class="list list-truyen list-new col-xs-12 col-sm-12 col-md-8 col-truyen-main">
            <div class="title-list">
                <h2><a href="{{route('danhsach.truyenmoi')}}" title="Truyện mới">Sách mới cập nhật <span class="glyphicon glyphicon-menu-right"></span></a></h2>
                <select id="new-select" class="form-control new-select">
                    <option value="all">Tất cả</option>
                    {{ category_parent(\App\Category::get()) }}
                </select>
            </div>
                {!!  \App\Story::getListNewStories()  !!}
        </div>

        {{--Sidebar--}}
        <div class="visible-md-block visible-lg-block col-md-4 text-center col-truyen-side">
            @include('widgets.categories')
            @include('widgets.ads')
        </div>
    </div>

    {!!  \App\Story::getListDoneStories()  !!}
@endsection
