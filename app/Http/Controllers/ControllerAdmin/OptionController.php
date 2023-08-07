<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Option;

class OptionController extends Controller
{
    /**
     * hiển thị giao diện trang chỉnh sửa thông tin trang
     */
    public function index()
    {
        $settings = true;
        return view('admin.setting.index', compact('settings'));
    }
    // update dữ liệu hệ thống trang
    public function update(Request $request)
    {

        $data = $request->all();
        foreach($data as $key => $value)
        {
            if($key != '_token' && $key != '_method')
                Option::put($key, $value);
        }
        if(($request->hasFile('fImages')))
        {
            @unlink(public_path('admin/dist/images/watermark.png'));
            $request->file('fImages')->move(public_path('admin/dist/images'), 'watermark.png');
        }
        return redirect()->route($data['_redirect'])->with('success', 'Mọi thay đổi đã lưu thành công !');
    }

    /**
     * load giao diện trang chỉnh sửa thông tin quảng cáo
     */
    public function tos()
    {
        return view('admin.setting.tos');
    }
    /**
     * load giao diện trang chỉnh sửa thông tin điều khoản
     */
    public function ads()
    {
        return view('admin.setting.ads');
    }
}
