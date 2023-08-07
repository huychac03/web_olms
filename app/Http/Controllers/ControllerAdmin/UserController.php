<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * active menu
     */
    public function __construct()
    {
        view()->share([
            'user_menu' => true,
        ]);
    }
    /**
     * Load danh sách quản trị viên
     */
    public function index()
    {
        $datas = User::orderBy('updated_at', 'DESC')->get();
        return view('admin.user.index', compact('datas'));
    }

    /**
     * load giao diện thêm mới quản trị viên
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * thực hiện thêm mới quản trị viên
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'txtName' => 'required|max:255',
            'txtEmail' => 'required|email|max:255|unique:users,email',
            'txtPassword' => 'required|confirmed|min:6',
        ], [
            'txtName.required' => 'Bạn chưa điền tên',
            'txtName.max' => 'Tên chỉ tối đa 255 ký tự',
            'txtEmail.required' => 'Bạn chưa điền Email',
            'txtEmail.unique' => 'Email này đã được sử dụng',
            'txtEmail.max' => 'Email chỉ tối đa 255 ký tự',
            'txtEmail.email' => 'Không đúng định dạng Email',
            'txtPassword.required' => 'Bạn chưa điền mật khẩu',
            'txtPassword.confirmed' => 'Xác nhận mậy khẩu không khớp',
            'txtPassword.min' => 'Mật khẩu ít nhất phải có 6 ký tự',
        ]);

        User::create([
            'name' => $request->txtName,
            'email' => $request->txtEmail,
            'password' => bcrypt($request->txtPassword),
            'level' => $request->txtLevel,
            'status' => 1,
            'point' => $request->txtPoint,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Thêm truyện mới thành công !');
    }

    /**
     * load giao diện chỉnh sửa quản trị viên
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.user.index')->with('danger','Dữ liệu không tồn tại');
        }
        return view('admin.user.edit', compact('user'));
    }

    /**
     * update thông tin thành viên
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'txtName' => 'required|max:255',
            'txtEmail' => 'required|email|max:255',
            'txtPassword' => 'nullable|confirmed|min:6',
        ], [
            'txtName.required' => 'Bạn chưa điền tên',
            'txtName.max' => 'Tên chỉ tối đa 255 ký tự',
            'txtEmail.required' => 'Bạn chưa điền Email',
            'txtEmail.max' => 'Email chỉ tối đa 255 ký tự',
            'txtEmail.email' => 'Không đúng định dạng Email',
            'txtPassword.confirmed' => 'Xác nhận mậy khẩu không khớp',
            'txtPassword.min' => 'Mật khẩu ít nhất phải có 6 ký tự',
        ]);

        $user = User::find($id);
        $user->name = $request->txtName;
        $user->email = $request->txtEmail;
        if(!empty($request->txtPassword_confirmation)) {
            $user->password = bcrypt($request->txtPassword_confirmation);
        }
        $user->level = $request->txtLevel;
        $user->status = 1;
        $user->point = $request->txtPoint;


        if ($user->save()) {
            return redirect()->route('admin.user.update', $id)->with('success','Chỉnh sửa thành công');
        } else {
            return redirect()->route('admin.user.index')->with('danger', 'Đã xảy ra lỗi không thể chỉnh sửa');
        }
    }

    /**
     * Xóa thông tin thành viên
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user.index')->with('danger','Dữ liệu không tồn tại');
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success','Xóa thành công');
    }

    /**
     * Đổi mật khẩu
     */
    public function passwordChange(Request $request)
    {
        $this->validate($request, [
            'txtPassword' => 'confirmed|min:6',
        ], [
            'txtPassword.confirmed' => 'Xác nhận mậy khẩu không khớp',
            'txtPassword.min' => 'Mật khẩu ít nhất phải có 6 ký tự',
        ]);
        $user = User::find(\Auth::user()->id);
        $user->password = bcrypt($request->txtPassword);
        $user->save();
        return redirect()->route('dashboard.changepassword')->with('success', 'Đã đổi mật khẩu thành công !');

    }
}
