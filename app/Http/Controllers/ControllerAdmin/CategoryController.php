<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * activer menu
     */
    public function __construct()
    {
        view()->share([
            'category_menu' => true,
        ]);
    }
    /*
     * Load dữ liệ chuyên mục
     */
    public function index(Request $request)
    {
        $datas = Category::select('id', 'name', 'parent_id');
        if ($request->name) {
            $datas->where('name', 'like', '%'. $request->name .'%');
        }
        $datas = $datas->with('parent')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.category.index', compact('datas'));
    }
    /*
     * Hiển thị giao diện thêm mới chuyên mục
     */
    public function create()
    {
        // hiển thị danh mục cha
        $parent = Category::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.category.create', compact('parent'));
    }
    /*
     * Thực hiện thêm mới chuyên mục
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->name      = $request->name;
        $category->alias     = changeTitle($request->name);
        $category->parent_id = (int) $request->parent_id;
        $category->keyword   = $request->keyword;
        $category->description = $request->description;
        if ($category->save()) {
            return redirect()->route('admin.category.create')->with('success','Thêm mới thành công');
        } else {
            return redirect()->route('admin.category.create')->with('danger','Đã xảy ra lỗi không thể thêm chuyên mục');
        }

    }
    /*
     * hiển thị giao diện chỉnh sửa
     */
    public function edit($id)
    {

        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.category.index')->with('danger','Dữ liệu không tồn tại');
        }
        $parent = Category::select('id', 'name', 'parent_id')->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('admin.category.edit', compact('parent', 'category'));
    }
    /*
     * thực hiện update chuyên mục
     */
    public function update(CategoryRequest $request, $id)
    {

        $category = Category::find($id);
        $category->name      = $request->name;
        $category->alias     = changeTitle($request->name);
        $category->parent_id = (int) $request->parent_id;
        $category->keyword   = $request->keyword;
        $category->description = $request->description;

        if ($category->save()) {
            return redirect()->route('admin.category.update', $request->id)->with('success','Chỉnh sửa thành công');
        } else {
            return redirect()->route('admin.category.update', $request->id)->with('danger','Đã xảy ra lỗi không thể chỉnh sửa chuyên mục');
        }
    }

    /*
     * Thực hiện xóa chuyên mục
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.category.index')->with('danger','Dữ liệu không tồn tại');
        }

        $parent = Category::where('parent_id', $id)->count();
        if($parent == 0){
            $category->delete();
            return redirect()->route('admin.category.index')->with('success','Xóa thành công');
        }
        return redirect()->route('admin.category.index')->with('success','Xóa chuyên mục không thành công, chuyên mục này tồn tại chuyên mục con !');
    }
}
