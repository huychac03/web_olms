@extends('admin.layouts.app')
@section('title-admin','Bảng Quản Trị')
@section('content')

    <!-- Main content -->
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bảng Quản Trị</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form  method="POST" id="dqhStoryFormLeech">
                        <div class="box-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Chọn Trang</label>
                                <select id="type" class="form-control">
                                    <option value="santruyen.com">SanTruyen.com</option>
                                    <option value="thichtruyen.vn">ThichTruyen.vn</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>URL</label>
                                <input type="text" id="url"  class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Chuyên mục</label>
                                <select name="intCategory[]" data-placeholder="Chọn chuyên mục" id="selectCategory" class="form-control chosen-select" multiple>
                                    <option value=""></option>
                                    {{ category_parent($categories) }}
                                </select>

                                <a href="#" class="btn btn-link" id="addNewCategory"><i class="fa fa-plus"></i> Thêm Chuyên Mục Mới</a>
                                <div id="addNewCategoryF">
                                    <div class="form-inline" >
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nameCategory" placeholder="Tên chuyên mục">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="createCategory">Thêm</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tác giả</label>
                                <select name="intAuthor[]" data-placeholder="Chọn chuyên mục" class="form-control chosen-select" id="selectAuthor" multiple>
                                    <option value=""></option>
                                    {{ author_options($authors) }}
                                </select>
                                <a href="#" class="btn btn-link" id="addNewAuthor"><i class="fa fa-plus"></i> Thêm Tác giả Mới</a>
                                <div id="addNewAuthorF">
                                    <div class="form-inline" >
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nameAuthor" placeholder="Tên tác giả">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="createAuthor">Thêm</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Chạy</button>
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

@section('script')
    <script>
        $('.progress').hide();
        $("#dqhStoryFormLeech").on('submit', function(e){
            e.preventDefault();
            typeWeb = $("#type").val();
            url     = $("#url").val();
            categories = $("#selectCategory").val();
            authors = $("#selectAuthor").val();

            $.ajax({
                url: '/admin/api/leech/story',
                type: 'GET',
                dataType: 'json',
                data: {'type': typeWeb, 'url': url, 'categoriesID': categories, 'authorID': authors},
                success: function(data){
                    $("#log").text("<br>Đã nhận được thông tin truyện ...<br>");
                    $("#log").append("Đang lấy thông tin ...<br>");
                    $("#log").append("Đã lưu...Lấy chương truyện<br>");

                    $.each(data.chapters,function(k, v){
                        $.ajax({
                            url: '/admin/api/leech/chapter',
                            type: 'GET',
                            dataType: 'json',
                            data: {'type': typeWeb, 'url': v, 'story_id': data.story_id},
                            success: function(data){
                                $("#log").append("Chapter -> " + data.title + " -> " + data.status +  "<br>");
                            },
                        })
                            .fail(function(){
                                $('.progress').hide();
                                $("#log").append('Có lỗi xuất hiện!<br>');
                            });
                    });
                    $("#log").append("== DONE == <br/>");
                },
            })
                .fail(function(){
                    $('.progress').hide();
                    $("#log").append('Có lỗi xuất hiện!<br>');
                });
            return false;
        });

    </script>
@endsection()