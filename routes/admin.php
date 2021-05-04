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

        Route::get('/', 'Tracker\IndexController@index')->name('index');
        Route::get('errors', 'Tracker\IndexController@errors')->name('errors');
        Route::get('apiErrors', 'Tracker\IndexController@apiErrors')->name('apiErrors');
        Route::get('events', 'Tracker\IndexController@events')->name('events');
        Route::get('apiEvents', 'Tracker\IndexController@apiEvents')->name('apiEvents');
        Route::get('event/{id}', 'Tracker\IndexController@event')->name('event');
        Route::get('apiVisits', 'Tracker\IndexController@apiVisits')->name('apiVisits');
        Route::get('log/{uuid}', 'Tracker\IndexController@log')->name('log');
        Route::get('apiLog/{uuid}', 'Tracker\IndexController@apiLog')->name('apiLog');

    });

    // Rok
    Route::group(['prefix'=>'/year', 'as' => 'year.'], function() {
        Route::get('closed/{year}', 'Year\IndexController@closed')->name('closed');
    });


    Route::group(['prefix'=>'/post', 'as' => 'post.'], function() {
        Route::get('{project}', 'Post\IndexController@show')->name('show');
    });

    Route::group(['prefix'=>'/userproject', 'as' => 'userproject.'], function() {
        Route::get('/create/{project}', 'UserProject\IndexController@create')->name('create');
        Route::post('/store', 'UserProject\IndexController@store')->name('store');
        Route::get('/delete/{user}/project/{project}', 'UserProject\IndexController@destroy')->name('delete');
    });

    // Projekt
    Route::group(['prefix'=>'/project', 'as' => 'project.', 'middleware' => 'checkProject'], function() {
        Route::get('/create', 'Project\IndexController@create')->name('create');
        Route::post('/store', 'Project\IndexController@store')->name('store');
        Route::post('/upload', 'Project\IndexController@upload')->name('upload');
        Route::get('/deletefile/{id}', 'Project\IndexController@deletefile')->name('deletefile');
        Route::get('/{project}/edit', 'Project\IndexController@edit')->name('edit');
        Route::put('/{project}', 'Project\IndexController@update')->name('update');
        Route::get('{project}', 'Project\IndexController@show')->name('show');
        Route::get('{project}/charts', 'Project\IndexController@charts')->name('charts');
        Route::get('{project}/calendar', 'Project\IndexController@calendar')->name('calendar');
        Route::get('{project}/chats', 'Project\IndexController@chats')->name('chats');
        Route::get('{project}/chats', 'Project\IndexController@chats')->name('chats');
    });

    // Szukaj
    Route::get('/autocomplete', 'Project\IndexController@search');

    // Dashboard
    Route::group(['prefix'=>'/dashboard', 'as' => 'dashboard.'], function() {
        Route::resources([
            '/' => 'Dashboard\IndexController'
        ]);

    });
});
