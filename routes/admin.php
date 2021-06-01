<?php

use Illuminate\Support\Facades\Route;

// kCMS
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {

    Route::get('/', function () {
        return redirect('admin/dashboard');
    });

    Route::resources([
        'user' => 'User\IndexController',
        'role' => 'Role\IndexController',
        'logs' => 'Log\IndexController',
        'greylist' => 'Greylist\IndexController',
        'year' => 'Year\IndexController',
        'clientproject' => 'ClientProject\IndexController'
    ]);

    // Tracker
    Route::group(['prefix'=>'/tracker', 'as' => 'tracker.'], function() {

        Route::get('/',             'Tracker\IndexController@index')->name('index');
        Route::get('errors',        'Tracker\IndexController@errors')->name('errors');
        Route::get('apiErrors',     'Tracker\IndexController@apiErrors')->name('apiErrors');
        Route::get('events',        'Tracker\IndexController@events')->name('events');
        Route::get('apiEvents',     'Tracker\IndexController@apiEvents')->name('apiEvents');
        Route::get('event/{id}',    'Tracker\IndexController@event')->name('event');
        Route::get('apiVisits',     'Tracker\IndexController@apiVisits')->name('apiVisits');
        Route::get('log/{uuid}',    'Tracker\IndexController@log')->name('log');
        Route::get('apiLog/{uuid}', 'Tracker\IndexController@apiLog')->name('apiLog');

    });

    // Year
    Route::group(['prefix'=>'/year', 'as' => 'year.'], function() {
        Route::get('closed/{year}', 'Year\IndexController@closed')->name('closed');
    });


    Route::group(['prefix'=>'/post', 'as' => 'post.'], function() {
        Route::get('{project}',     'Post\IndexController@show')->name('show');
    });

    Route::group(['prefix'=>'/privatepost', 'as' => 'privatepost.'], function() {
        Route::get('{project}',     'PrivateProject\AjaxController@show')->name('show');
    });

    Route::group(['prefix'=>'/userproject', 'as' => 'userproject.'], function() {
        Route::get('/create/{project}',                 'UserProject\IndexController@create')->name('create');
        Route::post('/store',                           'UserProject\IndexController@store')->name('store');
        Route::get('/delete/{user}/project/{project}',  'UserProject\IndexController@destroy')->name('delete');
    });

    // Project
    Route::group(['prefix'=>'/project', 'as' => 'project.', 'middleware' => 'checkProject'], function() {

        Route::get('private',                   'PrivateProject\IndexController@index')->name('private.index');
        Route::get('private/create',            'PrivateProject\IndexController@create')->name('private.create');
        Route::post('private/store',            'PrivateProject\IndexController@store')->name('private.store');
        Route::get('private/{project}/edit',    'PrivateProject\IndexController@edit')->name('private.edit');
        Route::put('private/{project}',         'PrivateProject\IndexController@update')->name('private.update');
        Route::get('private/{project}',         'PrivateProject\IndexController@show')->name('private.show');

        Route::get('create',            'Project\IndexController@create')->name('create');
        Route::post('store',            'Project\IndexController@store')->name('store');
        Route::get('{project}/edit',    'Project\IndexController@edit')->name('edit');
        Route::put('{project}',         'Project\IndexController@update')->name('update');
        Route::get('{project}',         'Project\IndexController@show')->name('show');

        // Project - Charts
        Route::get('{project}/charts',  'Project\ChartController@index')->name('charts');

        // Project - Calendar
        Route::get('{project}/calendar','Project\CalendarController@index')->name('calendar');

        // Project - Files
        Route::post('upload',           'Project\FileController@store')->name('upload');
        Route::get('deletefile/{id}',   'Project\FileController@destroy')->name('deletefile');

        // Project - Chat
        Route::get('{project}/chat',                    'Project\ChatController@index')->name('chat');
        Route::get('{project}/chat/create',             'Project\ChatController@create')->name('chat.create');
        Route::post('{project}/chat',                   'Project\ChatController@store')->name('chat.store');
        Route::get('{project}/chat/{chat}/edit',        'Project\ChatController@edit')->name('chat.edit');
        Route::put('{project}/chat/{chat}',             'Project\ChatController@update')->name('chat.update');
        Route::get('{project}/chat/{chat}',             'Project\ChatController@show')->name('chat.show');
        Route::delete('{project}/chat/{chat}',          'Project\ChatController@destroy')->name('chat.destroy');

        // Project - Chat - Reply
        Route::get('{reply}/helpful',                           'Project\ReplyController@helpful')->name('reply.helpful');
        Route::get('{project}/chat/{chat}/reply',               'Project\ReplyController@create')->name('reply.create');
        Route::post('{project}/chat/{chat}/reply',              'Project\ReplyController@store')->name('reply.store');
        Route::get('{project}/chat/{chat}/reply/{reply}/edit',  'Project\ReplyController@edit')->name('reply.edit');
        Route::put('{project}/chat/{chat}/reply/{reply}',       'Project\ReplyController@update')->name('reply.update');
        Route::delete('/reply/{reply}',                         'Project\ReplyController@destroy')->name('reply.destroy');

        // Project - Post
        Route::get('{project}/posts/create',        'Project\PostController@create')->name('post.create');
        Route::post('{project}/posts',              'Project\PostController@store')->name('post.store');
        Route::get('{project}/posts/{post}/edit',   'Project\PostController@edit')->name('post.edit');
        Route::put('posts/{post}',                  'Project\PostController@update')->name('post.update');
        Route::delete('/posts/{post}',              'Project\PostController@destroy')->name('post.destroy');

        // Project - Private Post
        Route::get('private/{project}/posts/create',        'PrivateProject\PostController@create')->name('private.post.create');
        Route::post('private/{project}/posts',              'PrivateProject\PostController@store')->name('private.post.store');
        Route::get('private/{project}/posts/{post}/edit',   'PrivateProject\PostController@edit')->name('private.post.edit');
        Route::put('private/posts/{post}',                  'PrivateProject\PostController@update')->name('private.post.update');
        Route::delete('private/posts/{post}',              'PrivateProject\PostController@destroy')->name('private.post.destroy');

        Route::get('{project}/posts/{post}/move',   'Project\PostMoveController@edit')->name('post.move');
        Route::put('{post}/moved',                  'Project\PostMoveController@update')->name('post.moved');
    });

    // Search
    Route::get('/autocomplete', 'Project\SearchController@index');

    // Dashboard
    Route::group(['prefix'=>'/dashboard', 'as' => 'dashboard.'], function() {
        Route::resources([
            '/' => 'Dashboard\IndexController'
        ]);

    });
});
