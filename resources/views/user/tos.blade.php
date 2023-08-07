@extends('user.layouts.app')
@section('title', 'Điều khoản sử dụng')
@section('breadcrumb')
    {!! showBreadcrumb([[url('tos'), 'Điều khoản sử dụng']]) !!}
@endsection
@section('content')
    <div class="container single-page" id="tos">
        <div class="row">
            <div class="list list-truyen col-xs-12">
                <div class="title-list"><h2>Privacy &amp; Terms of use - Điều khoản sử dụng</h2></div>
                <div class="row">
                    <div class="col-xs-12 content">
                        {!! \App\Models\Option::getvalue('tos_content') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
