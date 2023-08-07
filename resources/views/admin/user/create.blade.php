@extends('admin.layouts.app')
@section('title-admin','Thêm mới quản trị')
@section('content')

    <!-- Main content -->
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới thành viên</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    @include('admin.user.form')
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
@endsection