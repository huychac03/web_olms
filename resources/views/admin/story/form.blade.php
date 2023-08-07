
<form action="" method="POST" enctype="multipart/form-data">
    <div class="box-body">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('txtName') ? 'has-error' : '' }}">
            <label>Tên truyện</label>
            <input class="form-control" name="txtName" value="{{ old('txtName', isset($story) ? $story->name : '') }}"/>
            @if($errors->has('txtName'))
                <span class="help-block">{{$errors->first('txtName')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('intCategory') ? 'has-error' : '' }}">
            <label>Chuyên mục </label>
            <select name="intCategory[]" data-placeholder="Chọn chuyên mục" id="selectCategory" class="form-control chosen-select" multiple>
                <option value=""></option>
                @if(isset($story))
                    {{ category_parent($categories, $story->categories) }}
                @else
                    {{ category_parent($categories) }}
                @endif
            </select>
            @if($errors->has('intCategory'))
                <span class="help-block">{{$errors->first('intCategory')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('intAuthor') ? 'has-error' : '' }}">
            <label>Tác giả</label>
            <select name="intAuthor[]" data-placeholder="Chọn tác giả" class="form-control chosen-select" id="selectAuthor" multiple>
                <option value=""></option>
                @if(isset($story))

                    {{ author_options($authors, $story->authors) }}
                @else
                    {{ author_options($authors) }}
                @endif
            </select>
            @if($errors->has('intAuthor'))
                <span class="help-block">{{$errors->first('intAuthor')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('txtDescription') ? 'has-error' : '' }}">
            <label>Mô tả ngắn</label>
            <textarea name="txtDescription" id="txtDescription" class="form-control" rows="3">{{ old('txtDescription', isset($story) ? $story->description : '') }}</textarea>
            <script>
                ckeditor(txtDescription);
            </script>
        </div>

        <div class="form-group {{ $errors->has('txtContent') ? 'has-error' : '' }}">
            <label>Mô tả nội dung</label>
            <textarea class="form-control editor" rows="10" name="txtContent" id="txtContent" >{{ old('txtContent', isset($story) ? $story->content : '') }}</textarea>
            @if($errors->has('txtContent'))
                <span class="help-block">{{$errors->first('txtContent')}}</span>
            @endif
            <script>
                ckeditor(txtContent);
            </script>
        </div>
        <div class="form-group  {{ $errors->has('fImages') ? 'has-error' : '' }}">
            <label>Ảnh đại diện</label>
            <input type="file" name="fImages">
            @if (isset($story) && !empty($story->image))
                <div style="width: 300px; height: 400px; background: url({{ url($story->image) }}); background-size: 100% 100%; margin-top: 20px"></div>
            @endif
            @if($errors->has('fImages'))
                <span class="help-block">{{$errors->first('fImages')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label>Từ khoá</label>
            <input class="form-control" name="txtKeyword" value="{{ old('txtKeyword', isset($story) ? $story->keyword : '') }}"/>
        </div>


        <div class="form-group {{ $errors->has('txtSource') ? 'has-error' : '' }}">
            <label>Nguồn truyện</label>
            <input class="form-control" name="txtSource" value="{{ old('txtSource', isset($story) ? $story->source : '') }}" />
            @if($errors->has('txtSource'))
                <span class="help-block">{{$errors->first('txtSource')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label>Tình trạng</label>
            <select name="selStatus" class="form-control">
                <option value="0" {{ isset($story) && $story->status == 0 ? 'selected="selected"' : '' }}>Đang cập nhật</option>
                <option value="1" {{ isset($story) && $story->status == 1 ? 'selected="selected"' : '' }}>Hoàn thành</option>
                <option value="2" {{ isset($story) && $story->status == 2 ? 'selected="selected"' : '' }} >Ngưng cập nhật</option>
            </select>
        </div>
        @php
            $level = \Auth::user()->level
        @endphp
        @if($level == 2 || $level == 3)
        <div class="form-group">
            <label>Trạng thái</label>
            <select name="active" class="form-control">
                <option value="1" {{ isset($story) && $story->active == 1 ? 'selected="selected"' : '' }}>Đã duyệt</option>
                <option value="0" {{ isset($story) && $story->active == 0 ? 'selected="selected"' : '' }}>Chưa duyệt</option>
            </select>
        </div>
        @endif
        @if (isset($story))
            <input type="hidden" value="update" name="action">
        @endif
        <button type="submit" class="btn btn-primary" name="@if(isset($story)) create @else update @endif">@if(isset($story)) Chỉnh sửa truyện  @else Đăng truyện @endif</button>
        <button type="reset" class="btn btn-danger">Làm lại</button>
    </div>
</form>