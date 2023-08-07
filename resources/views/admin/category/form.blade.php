<form action="" method="POST">
    <div class="box-body">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Chuyên mục cha</label>
            <select name="parent_id" class="form-control">
                <option value="0">Không có</option>
                @if (isset($category))
                    {{ category_parent($parent, $category->parent_id) }}
                @else
                    {{ category_parent($parent) }}
                @endif
            </select>

        </div>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Tên chuyên mục <span class="text-danger">*</span></label>
            <input class="form-control" name="name" placeholder="Nhập tên của chuyên mục" value="{{ old('name', isset($category) ? $category->name : '') }}"/>
            @if($errors->has('name'))
                <span class="help-block">{{$errors->first('name')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('keyword') ? 'has-error' : '' }}">
            <label>Từ khóa tìm kiếm <span class="text-danger">*</span></label>
            <input class="form-control" name="keyword" placeholder="Từ khóa thứ 1, từ khóa 2, từ khóa 3" value="{{ old('keyword', isset($category) ? $category->keyword : '') }}"/>
            @if($errors->has('keyword'))
                <span class="help-block">{{$errors->first('keyword')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary"> @if(isset($category)) Chỉnh sửa @else Tạo mới @endif</button>
        <button type="reset" class="btn btn-danger">Làm lại</button>
    </div>
</form>