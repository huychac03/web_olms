@extends('admin.layouts.app')
@section('title', 'Bảng Quản Trị')
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Thông tin</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>Tên</td>
                                            <td><strong>{{ Auth::user()->name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Chức vụ</td>
                                            <td><strong>{{ levelName(Auth::user()->level) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ Auth::user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngày tham gia</td>
                                            <td>{{ Auth::user()->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{ route('change.password') }}">Đổi mật khẩu</a></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if(Auth::user()->isComposer())

                            <div class="col-sm-6">
                                <div class="panel panel-default" style="height: 280px;">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Thống kê</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>Tổng số bài viết</td>
                                                <td><strong>{{ Auth::user()->stories()->count() }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ route('admin.story.create') }}">Đăng sách mới</a></td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        @endif

                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">sách đang xem</h3>
                                </div>
                                 <div class="panel-body">
                                    <?php
                                        $viewed = new \App\Models\Viewed;
                                        $data = $viewed->getListReading();
                                        if(count($data) > 0):
                                    ?>
                                    <ul>
                                        @foreach ($data as $item)
                                            @if(isset($item->story))
                                            <li><a href="{{route('story.show', $item->story->alias)}}/">{{ $item->story->name}}</a> (<a href="{{route('chapter.show', [$item->story->alias, $item->chapter->alias])}}">Đọc tiếp {{ $item->chapter->subname}}</a>)</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <?php else: ?>
                                    <p>
                                        Bạn chưa đọc sách nào cả :)
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Bảng xếp hạng</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>Tên người đăng</td>
                                            <td>Tổng lượt xem</td>
                                        </tr>
                                        @foreach($charts as $key => $value)
                                            @if($key < 5 )
                                                <tr>
                                                    <td>{{ $value['name'] }}</td>
                                                    <td>{{ $value['view'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
@endsection