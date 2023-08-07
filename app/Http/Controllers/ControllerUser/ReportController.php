<?php

namespace App\Http\Controllers\ControllerUser;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Report::orderBy('id', 'DESC')->paginate(20);
      return view('admin.report.index', compact('data'));
    }

    public function store(Request $request)
    {
        $chapter_id = \App\Chapter::find($request->chapterID);
        $message    = $request->reportMessenge;

        if(!$chapter_id || !$message) abort(403);

        $report = new Report;
        $report->chapter_id = $chapter_id->id;
        $report->message    = $message;
        // $report->solved     = 0;
        $report->save();
        return 'OK';
    }

    public function destroy(Report $report)
    {
        if($report){
            $report->delete();
            return redirect()->route('dashboard.report.index')->with(['flash_message'=> 'Hủy báo cáo thành công !', 'flash_level'=> 'success']);
        }
        return redirect()->route('dashboard.report.index')->with(['flash_message'=> 'Hủy báo cáo không thành công!', 'flash_level'=> 'danger']);
    }
}
