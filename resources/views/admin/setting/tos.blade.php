@extends('admin.layouts.app')
@section('title-admin','Chỉnh sửa điều khoản')
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chỉnh sửa điều khoản</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_redirect" value="admin.setting.tos">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="tos_content" id="tos_content" class="form-control editor" cols="30" rows="20">{{ old('tos_content', \App\Models\Option::getvalue('tos_content'))}}</textarea>
                                <script>
                                    ckeditor(tos_content);
                                </script>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm lại</button>
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