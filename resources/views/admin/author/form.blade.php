<form action="" method="POST">
    <div class="box-body">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Tên tác giả</label>
            <input class="form-control" name="name" placeholder="Nhập tên của tác giả" value="{{ old('name', isset($author) ? $author->name : '') }}"/>
            @if($errors->has('name'))
                <span class="help-block">{{$errors->first('name')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('keyword') ? 'has-error' : '' }}">
            <label>Từ khóa tìm kiếm</label>
            <input class="form-control" name="keyword" placeholder="Từ khóa thứ 1, từ khóa 2, từ khóa 3" value="{{ old('keyword', isset($author) ? $author->keyword : '') }}"/>
            @if($errors->has('keyword'))
                <span class="help-block">{{$errors->first('keyword')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', isset($author) ? $author->description : '') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary"> @if(isset($author)) Chỉnh sửa @else Tạo mới @endif</button>
        <button type="reset" class="btn btn-danger">Làm lại</button>

    </div>
</form>