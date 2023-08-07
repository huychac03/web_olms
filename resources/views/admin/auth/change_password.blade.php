@extends('admin.layouts.app')
@section('title-admin','Đổi mật khẩu')
@section('content')

<!-- Main content -->
<section class="content-header">
    <div class="col-xs-12">
        <div class="box">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Đổi mật khẩu</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('post.change.password') }}" method="POST">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('currentPassword') ? 'has-error' : '' }}">
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" name="currentPassword" placeholder="Nhập mật khẩu hiện tại" />
                            @if($errors->has('currentPassword'))
                                <span class="help-block">{{$errors->first('currentPassword')}}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('txtPassword') ? 'has-error' : '' }}">
                            <label>Mật khẩu mới</label>
                            <input type="password" class="form-control" name="txtPassword" placeholder="Nhập mật khẩu mới" />
                            @if($errors->has('txtPassword'))
                            <span class="help-block">{{$errors->first('txtPassword')}}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('txtPassword_confirmation') ? 'has-error' : '' }}">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="txtPassword_confirmation" placeholder="Nhập lại mật khẩu" />
                            @if($errors->has('txtPassword_confirmation'))
                            <span class="help-block">{{$errors->first('txtPassword_confirmation')}}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        <button type="reset" class="btn btn-danger">Làm lại</button>

                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</section>
<!-- /.content -->
@endsection