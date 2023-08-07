<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * activer menu
     */
    public function __construct()
    {
        view()->share([
            'author_menu' => true,
        ]);
    }
    /*
     * hiển thị danh sách tác giả
     */
    public function index(Request $request)
    {
        $datas = Author::select('id', 'name');

        if ($request->name) {
            $datas->where('name', 'like', '%'. $request->name .'%');
        }
        $datas = $datas->orderBy('id', 'DESC')->paginate(10);

        return view('admin.author.index', compact('datas'));
    }

    /*
     * hiển thị giao diện thêm mới tác giả
     */
    public function create()
    {
        return view('admin.author.create');
    }
    /*
     * Thực hiện insert dữ liệu
     */
    public function store(AuthorRequest $request)
    {
        $author = new Author;
        $author->name      = $request->name;
        $author->alias     = changeTitle($request->name);
        $author->keyword   = $request->keyword;
        $author->description = $request->description;
        $author->save();
        if ($author->save()) {
            return redirect()->route('admin.author.create')->with('success', 'Thêm mới thành công');
        } else {
            return redirect()->route('admin.author.create')->with('danger', 'Đã xảy ra lỗi không thể thêm dữ liệu');
        }
    }

    /*
     * load giao diện chỉnh sửa dữ liệu
     */
    public function edit($id)
    {
        if(!\Auth::user()->isAdmin()) {
            return redirect()->route('dashboard.author.index')->with('danger','Bạn không phải quản trị viên !');
        }

        $author = Author::find($id);
        if (!$author) {
            return redirect()->route('admin.author.index')->with('danger','Dữ liệu không tồn tại');
        }

        return view('admin.author.edit', compact('author'));
    }
    /*
     * Thực hiện update dữ liệu
     */
    public function update(AuthorRequest $request, $id)
    {
        $author = Author::find($id);
        $author->name      = $request->name;
        $author->alias     = changeTitle($request->name);
        $author->keyword   = $request->keyword;
        $author->description = $request->description;

        if ($author->save()) {
            return redirect()->route('admin.author.update', $id)->with('success','Chỉnh sửa thành ông');
        } else {
            return redirect()->route('admin.author.update', $id)->with('danger','Đã xảy ra lỗi không thể thêm dữ liệu');
        }
    }
    /*
     * Xóa tác giả
     */
    public function destroy($id)
    {
        if(!\Auth::user()->isAdmin())
            return redirect()->route('admin.author.index')->with('danger','Bạn không phải quản trị viên !');
        $author    = Author::find($id);
        if (!$author) {
            return redirect()->route('admin.author.index')->with('danger','Dữ liệu không tồn tại');
        }
        $author->delete();
        return redirect()->route('admin.author.index')->with('success','Xóa thành công');
    }

}
