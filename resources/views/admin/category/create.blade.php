@extends('admin.layouts.app')
@section('title-admin','Thêm mới chuyên mục')
@section('content')

    <!-- Main content -->
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới chuyên mục</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    @include('admin.category.form')
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
@endsection