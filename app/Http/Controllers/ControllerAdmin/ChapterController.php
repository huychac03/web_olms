<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use App\Http\Requests\ChapterRequest;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Story;
use Illuminate\Support\Facades\View;
use Auth;

class ChapterController extends Controller
{
    /*
     * load danh sach chuong
     */
    public function index(Request $request)
    {

        $level = Auth::user()->level;
        $chapters = Chapter::select('chapters.*')->leftJoin('stories', 'stories.id', '=', 'chapters.story_id');
        if($level == 1) {
            $chapters = $chapters->where('user_id', Auth::user()->id);
        }
        $chapters = $chapters->orderBy('id', 'DESC')->get();

        return view('admin.chapter.index', compact('chapters'));
    }

    /**
     * @param $storyId
     *  load list chương
     */
    public function listChapter($storyId)
    {
        $chapters = Chapter::select('chapters.*')->leftJoin('stories', 'stories.id', '=', 'chapters.story_id')->where('story_id', $storyId)->orderBy('id', 'DESC')->get();
        $story    = Story::find($storyId);
        return view('admin.chapter.index', compact('story', 'chapters'));
    }

    /*
     * Hiển thị màn hình thêm mới chương
     */
    public function create($storyId)
    {
        $story    = Story::find($storyId);
        $chapterSubname = Chapter::theNextSubname($storyId);

        return view('admin.chapter.create', compact('chapterSubname', 'story'));
    }

    /*
     * Thêm dữ liệu chương truyện
     */
    public function store(ChapterRequest $request)
    {
        $chapter = new Chapter;
        $chapter->name      = $request->txtName;
        $chapter->subname   = $request->txtSubname;
        $chapter->alias     = changeTitle($request->txtSubname);
        $chapter->content   = $request->txtContent;
        $chapter->story_id  = $request->story_id;
        $chapter->active   = isset($request->active) ? $request->active : 0;
        $chapter->view      = 0;
        $chapter->point      = isset($request->status) ? $request->txtPoint : 0;
        $chapter->status      = isset($request->status) ? $request->status : 0 ;
        if ($chapter->save()) {
            return redirect()->route('admin.chapter.list', $chapter->story_id)->with('success','Thêm mới thành công');
        } else {
            return redirect()->route('admin.category.create')->with('danger', 'Đã xảy ra lỗi không thể thêm mới dữ liệu');
        }
    }

   /*
    * Load màn hình edit chương truyện
    */
    public function edit($id)
    {
        $chapter = Chapter::find($id);

        if (!$chapter) {
            return redirect()->route('admin.chapter.index')->with('danger', 'Dữ liệu không tồn tại');
        }

        $user_id = $chapter->story->user_id;
        $story = $chapter->story;

        if(!Auth::user()->isAdmin() && $user_id != Auth::user()->id)
            return redirect()->route('admin.chapter.index')->with('danger', 'Bài viết này không phải của bạn !');

        return view('admin.chapter.edit', compact('chapter', 'story'));
    }

    /**
     *
     *update chỉnh sửa chương
     */
    public function update(ChapterRequest $request, $id)
    {
        $chapter = Chapter::find($id);
        $chapter->name      = $request->txtName;
        $chapter->subname   = $request->txtSubname;
        $chapter->alias     = changeTitle($request->txtSubname);
        $chapter->content   = $request->txtContent;
        $chapter->active   = isset($request->active) ? $request->active : 0;
        $chapter->point      = isset($request->status) ? $request->txtPoint : 0;
        $chapter->status      = isset($request->status) ? $request->status : 0 ;
        if ($chapter->save()) {
            return redirect()->route('admin.chapter.list', $chapter->story_id)->with('success','Chỉnh sửa thành công');
        } else {
            return redirect()->route('admin.chapter.index')->with('danger', 'Đã xảy ra lỗi không thể chỉnh sửa');
        }
    }

    /**
     * Xóa thông tin chương
     */
    public function destroy($id)
    {
        $chapter = Chapter::find($id);
        if (!$chapter) {
            return redirect()->route('admin.chapter.index')->with('danger', 'Dữ liệu không tồn tại');
        }

        $user_id = $chapter->story->user_id;
        if(!Auth::user()->isAdmin() && $user_id != Auth::user()->id)
            return redirect()->route('admin.chapter.index')->with('danger', 'Bài viết này không phải của bạn !');
        $story_id = $chapter->story_id;

        if ($chapter->delete()) {
            return redirect()->route('admin.chapter.list', $story_id)->with('success','Xóa thành công dữ liệu');
        } else {
            return redirect()->route('admin.chapter.index')->with('danger', 'Đã xảy ra lỗi không thể xóa');
        }
    }

    public function activeStatus(Request $request, $id)
    {
        $chapter = Chapter::find($id);
        if (!$chapter) {
            return redirect()->route('admin.chapter.index')->with('danger','Dữ liệu không tồn tại');
        }
        $chapter->active = 1;
        $chapter->save();
        return redirect()->route('admin.chapter.list', $chapter->story_id)->with('success', 'Duyệt bài thành công !');
    }

}
