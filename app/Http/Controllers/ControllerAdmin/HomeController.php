<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * active menu
     */
    public function __construct()
    {
        view()->share([
            'home' => true,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * load giao diện trang chủ
     */
    public function index()
    {
        $charts = [];
        $datas = User::with([
            'stories' => function($stories) {
                $stories->select('id', 'name', 'user_id')->with([
                    'chapters' => function($chapters) {
                        $chapters->select('id', 'name', 'subname', 'view', 'story_id')->where('active', 1);
                    }])->where('active', 1);
            }
        ])->get();

        foreach ($datas as $key => $story) {
            $numberView = 0;
            if(isset($story->stories) && $story->stories->count() > 0) {
                foreach ($story->stories as $stories) {
                    if(isset($stories->chapters) && $stories->chapters->count() > 0) {
                        foreach ($stories->chapters as $chapters) {
                            $numberView = $numberView + $chapters->view;
                        }
                    }
                }
            }
            array_push($charts, ['name' => $story->name, 'view' => $numberView]);
        }
        usort($charts, function ($item1, $item2) {
            return $item2['view'] <=> $item1['view'];
        });

        return view('admin.home.index', compact('charts'));
    }
}
