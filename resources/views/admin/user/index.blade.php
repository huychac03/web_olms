@extends('admin.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Thành viên</h3>

                    <div class="box-tools">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>  Thêm thành viên mới</a>
                    </div>
                </div>
                <div class="box-header">
                    <div class="pull-left">
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered" id="dataTableList">
                        <thead>
                            <tr align="center">
                                <th width="3%">STT</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Chức vụ</th>
                                <th>Ngày tạo</th>
                                <td>Truyện đăng</td>
                                <td>Điểm</td>
                                <th>Công cụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $key => $item)
                                <tr>
                                    <td width="3%">{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <th>{{ $item->email }}</th>
                                    <td>{{ levelName($item->level) }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td><a href="{{route('admin.story.index', ['user_id' => $item->id])}}">{{ $item->stories()->count()  }}</a>
                                    <td>{{ $item->point }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.update', $item->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.user.delete', $item->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right" >

                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection
@section('script')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endsection