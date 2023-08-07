<form action="" method="POST">
    <div class="box-body">
        {{ csrf_field() }}
        @if (isset($story))
        <input class="form-control" name="story_id" type="hidden" value="{{ old('story_id', $story->id) }}"/>
        @endif
        <div class="form-group {{ $errors->has('txtSubname') ? 'has-error' : '' }}">
            <input class="form-control" name="txtSubname" value="{{ old('txtSubname', isset($chapter) ? $chapter->subname : $chapterSubname) }}"/>
            @if($errors->has('txtSubname'))
                <span class="help-block">{{$errors->first('txtSubname')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('txtName') ? 'has-error' : '' }}">
            <label>Tên chương</label>
            <input class="form-control" name="txtName" placeholder="Tên chương" value="{{ old('txtName', isset($chapter) ? $chapter->name : '') }}"/>
            @if($errors->has('txtName'))
                <span class="help-block">{{$errors->first('txtName')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('txtContent') ? 'has-error' : '' }}">
            <label>Nội dung</label>
            <textarea name="txtContent" id="txtContent" class="form-control" rows="3">{{ old('txtContent', isset($chapter) ? $chapter->content : '') }}</textarea>
            <script>
                ckeditor(txtContent);
            </script>
            @if($errors->has('txtContent'))
                <span class="help-block">{{$errors->first('txtContent')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('txtPoint') ? 'has-error' : '' }}">
            <label>Điểm thanh toán</label>
            <input type="number" class="form-control" name="txtPoint" value="{{ old('txtPoint', isset($chapter) ? $chapter->txtPoint : '') }}" min="0"/>
            @if($errors->has('txtPoint'))
                <span class="help-block">{{$errors->first('txtPoint')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label>Nội dung trả phí</label>
            <select name="status" class="form-control">
                <option value="1" {{ isset($story) && $story->status == 1 ? 'selected="selected"' : '' }}>Miễn phí</option>
                <option value="2" {{ isset($story) && $story->status == 0 ? 'selected="selected"' : '' }}>Trả phí</option>
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
        <button type="submit" class="btn btn-primary"> @if(isset($chapter)) Chỉnh sửa @else Tạo mới @endif</button>
        <button type="reset" class="btn btn-danger">Làm lại</button>

    </div>
</form>