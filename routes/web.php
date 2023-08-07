<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

/* admin */
Route::group(['prefix' => 'admin', 'namespace' => 'ControllerAdmin'], function (){
    /* login admin */
    Route::get('login', 'Auth\LoginController@login')->name('admin.login');
    Route::post('login', 'Auth\LoginController@postLogin');
    Route::get('logout', 'Auth\LoginController@logoutUser')->name('admin.logout');
    /* home */
    Route::group(['middleware' =>['auth']], function () {
        Route::group(['middleware' =>['admin']], function () {
            Route::get('home', 'HomeController@index')->name('admin.home');
            Route::get('leech', 'LeechController@index')->name('admin.leech');
            Route::get('change/password', 'Auth\ResetPasswordController@changePassword')->name('change.password');
            Route::post('post/change/password', 'Auth\ResetPasswordController@postChangePassword')->name('post.change.password');
            Route::group(['prefix' => 'category'], function() {
                Route::get('/', 'CategoryController@index')->name('admin.category.index');
                Route::get('/create', 'CategoryController@create')->name('admin.category.create');
                Route::post('/create', 'CategoryController@store');
                Route::get('/update/{id}', 'CategoryController@edit')->name('admin.category.update');
                Route::post('/update/{id}', 'CategoryController@update');
                Route::get('/delete/{id}', 'CategoryController@destroy')->name('admin.category.delete');
            });

            Route::group(['prefix' => 'author'], function() {
                Route::get('/', 'AuthorController@index')->name('admin.author.index');
                Route::get('/create', 'AuthorController@create')->name('admin.author.create');
                Route::post('/create', 'AuthorController@store');
                Route::get('/update/{id}', 'AuthorController@edit')->name('admin.author.update');
                Route::post('/update/{id}', 'AuthorController@update');
                Route::get('/delete/{id}', 'AuthorController@destroy')->name('admin.author.delete');
            });

            Route::group(['prefix' => 'story'], function() {
                Route::get('/', 'StoryController@index')->name('admin.story.index');
                Route::get('/create', 'StoryController@create')->name('admin.story.create');
                Route::post('/create', 'StoryController@store');
                Route::get('/update/{id}', 'StoryController@edit')->name('admin.story.update');
                Route::post('/update/{id}', 'StoryController@update');
                Route::get('/delete/{id}', 'StoryController@destroy')->name('admin.story.delete');
                Route::get('active/status/{id}', 'StoryController@activeStatus')->name('admin.active.status');
            });

            Route::group(['prefix' => 'chapter'], function() {
                Route::get('/', 'ChapterController@index')->name('admin.chapter.index');
                Route::get('/chapter/list/{storyId}', 'ChapterController@listChapter')->name('admin.chapter.list');
                Route::get('/create/{storyId}', 'ChapterController@create')->name('admin.chapter.create');
                Route::post('/create/{storyId}', 'ChapterController@store');
                Route::get('/update/{id}', 'ChapterController@edit')->name('admin.chapter.update');
                Route::post('/update/{id}', 'ChapterController@update');
                Route::get('/delete/{id}', 'ChapterController@destroy')->name('admin.chapter.delete');
                Route::get('active/status/chapter/{id}', 'ChapterController@activeStatus')->name('admin.active.status.chapter');
            });

            Route::group(['prefix' => 'user'], function() {
                Route::get('/', 'UserController@index')->name('admin.user.index');
                Route::get('/create', 'UserController@create')->name('admin.user.create');
                Route::post('/create', 'UserController@store');
                Route::get('/update/{id}', 'UserController@edit')->name('admin.user.update');
                Route::post('/update/{id}', 'UserController@update');
                Route::get('/delete/{id}', 'UserController@destroy')->name('admin.user.delete');
            });

            Route::group(['prefix' => 'setting'], function() {
                Route::get('/', 'OptionController@index')->name('admin.setting.index');
                Route::get('/update', 'OptionController@index')->name('admin.setting.update');
                Route::put('/update', 'OptionController@update');
                Route::get('/ads', 'OptionController@ads')->name('admin.setting.ads');
                Route::get('/tos', 'OptionController@tos')->name('admin.setting.tos');
            });

            // AJAX
            Route::group(['prefix' => 'api'], function(){
                Route::post('category', 'CategoryController@ajaxCreate')->name('admin.category.ajax.create');
                // leech tool
                Route::get('leech/story', 'LeechController@getListChapters');
                Route::get('leech/chapter', 'LeechController@getContentChapter');
            });
        });
    });
});

/* User */
Route::group(['namespace' => 'ControllerUser', 'middleware' => 'web'], function (){
    Route::get('/', 'HomeController@index')->name('user.home');
    Route::get('/user/login', 'Auth\LoginController@login')->name('user.login');
    Route::post('/user/login', 'Auth\LoginController@postLogin')->name('post.user.login');
    Route::get('/user/logout', 'Auth\LoginController@logout')->name('user.logout');
    Route::get('register', 'Auth\RegisterController@register')->name('register');
    Route::post('register', 'Auth\RegisterController@postRegister');
    Route::get('/home', function(){
        Session::forget('viewed.0');
        foreach (Session::get('viewed') as $key => $value) {
            echo $key;
        }
        //redirect('/');
    });

    // Page
    Route::get('tos', 'HomeController@tos');
    Route::get('contact', 'HomeController@contact');
    Route::put('contact', 'HomeController@sendContact')->middleware('api');
    Route::get('sitemap.xml', 'HomeController@sitemap');
    Route::post('payment/chapter/{id}', 'StoryController@paymentChapter')->name('payment.chapter');

    // Index List
    Route::get('the-loai/{category}', 'StoryController@getListByCategory')->name('category.list.index');
    Route::get('tac-gia/{author}', 'StoryController@getListByAuthor')->name('author.list.index');
    Route::group(['prefix' => 'danh-sach'], function() {
        Route::get('truyen-hot', 'StoryController@getListHotStory')->name('danhsach.truyenhot');
        Route::get('truyen-moi', 'StoryController@getListNewStory')->name('danhsach.truyenmoi');
        Route::get('truyen-full', 'StoryController@getListFullStory')->name('danhsach.truyenfull');
    });
    Route::get('search', 'StoryController@getListBySearch')->name('danhsach.search');
    // API
    Route::group(['prefix' => 'api', 'middleware' => 'api'], function(){
        Route::any('new-post', 'StoryController@getAjaxListNewStories');
        Route::any('hot-post', 'StoryController@getAjaxListHotStories');
        Route::any('report-chapter', 'ReportController@store');
    });
    //Show
    Route::get('{story}', 'StoryController@showInfoStory')->name('story.show');
    Route::get('{story}/{chapter}', 'StoryController@showInfoChapter')->name('chapter.show');
});