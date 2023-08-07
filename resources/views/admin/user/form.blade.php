<form action="" method="POST">
    <div class="box-body">
        {{ csrf_field() }}

        <div class="form-group {{ $errors->has('txtName') ? 'has-error' : '' }}">
            <label>Tên thành viên</label>
            <input type="text" class="form-control" name="txtName" placeholder="Nhập tên thành viên" value="{{ old('txtName', isset($user) ? $user->name : '') }}"/>
            @if($errors->has('txtName'))
                <span class="help-block">{{$errors->first('txtName')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('txtEmail') ? 'has-error' : '' }}">
            <label>Email</label>
            <input type="email" class="form-control" name="txtEmail" placeholder="Nhập email thành viên" value="{{ old('txtEmail', isset($user) ? $user->email : '') }}"/>
            @if($errors->has('txtEmail'))
                <span class="help-block">{{$errors->first('txtEmail')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('txtPassword') ? 'has-error' : '' }}">
            <label>Mật khẩu {{ isset($user) ? '(để trống để không thay đổi)' : ''}}</label>
            <input type="password" class="form-control" name="txtPassword" placeholder="Nhập mật khẩu thành viên" />
            @if($errors->has('txtPassword'))
                <span class="help-block">{{$errors->first('txtPassword')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('txtPassword_confirmation') ? 'has-error' : '' }}">
            <label>Mật khẩu xác nhận</label>
            <input type="password" class="form-control" name="txtPassword_confirmation" placeholder="Nhập mật khẩu thành viên" />
            @if($errors->has('txtPassword_confirmation'))
                <span class="help-block">{{$errors->first('txtPassword_confirmation')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('txtPoint') ? 'has-error' : '' }}">
            <label>Điểm </label>
            <input type="number" class="form-control" name="txtPoint" placeholder="Nhập điểm" value="{{ old('txtPoint', isset($user) ? $user->point : '') }}" min="0"/>
            @if($errors->has('txtPoint'))
                <span class="help-block">{{$errors->first('txtPoint')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label>Chức vụ</label>
            <select class="form-control" name="txtLevel" placeholder="Chọn chức vụ">
                <option value="0">Thành viên</option>
                <option value="1" {{ isset($user) && ($user->level == 1) ? 'selected' : '' }}>Biên soạn viên</option>
                <option value="2" {{ isset($user) && ($user->level == 2) ? 'selected' : '' }}>Biên tập viên</option>
                <option value="3" {{ isset($user) && ($user->level == 3) ? 'selected' : '' }}>Quản trị viên</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"> @if(isset($user)) Chỉnh sửa @else Tạo mới @endif</button>
        <button type="reset" class="btn btn-danger">Làm lại</button>

    </div>
</form>