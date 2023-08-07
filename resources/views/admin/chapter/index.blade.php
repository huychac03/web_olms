@extends('admin.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ isset($story->name) ? $story->name : 'Tổng hợp chương' }}</h3>

                    <div class="box-tools">
                        <a href="{{ route('admin.story.index') }}" class="btn btn-success"><i class="fa fa-book"></i> Quản lý truyện </a>
                        @if (isset($story))
                        <a href="{{ route('admin.chapter.index') }}" class="btn btn-success"><i class="fa fa-book"></i> Toàn bộ chương </a>
                        <a href="{{ route('admin.chapter.create', $story->id) }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm chương mới </a>
                        @endif
                    </div>
                </div>
                <div class="box-header">
                    <div class="pull-left">
                    </div>
                </div>
                @php
                    if(!isset(\Auth::user()->level)) {
                        return redirect()->route('admin.logout');
                    }
                    $level = \Auth::user()->level
                @endphp
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered" id="dataTableList">
                        <thead>
                            <tr align="center">
                                <th>Tên mục</th>
                                <th>Tên Chương</th>
                                @if (!isset($story->name))
                                    <th>Thuộc</th>
                                @endif
                                <th>Trạng thái</th>
                                <th>Điểm</th>
                                <th>Ngày Cập Nhật</th>
                                <th>Công cụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chapters as $key => $item)
                                <tr>
                                    <td>{{ $item->subname }}</td>
                                    <td>{{ $item->name }}</td>
                                    @if (!isset($story->name))
                                        <td>
                                            {{ isset($item->story)? $item->story->name : '' }}
                                        </td>
                                    @endif
                                    <td>
                                        <p class="status-code">
                                            @if($level == 2 || $level == 3)
                                                @if($item->active == 1)
                                                    Đã duyệt
                                                @else
                                                    <a href="{{ route('admin.active.status.chapter', $item->id) }}" class=" btn btn-success active-story" style="padding: 0px 12px !important;">Duyệt bài</a>
                                                @endif
                                            @else
                                                @if($item->active == 1)
                                                    Đã duyệt
                                                @else
                                                    Chưa duyệt
                                                @endif
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        {{  $item->point }}
                                    </td>
                                    <td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.chapter.update', $item->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        @if($level == 2 || $level == 3)
                                        <a href="{{ route('admin.chapter.delete', $item->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        @endif
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