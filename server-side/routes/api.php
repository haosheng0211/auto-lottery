<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('status', 'AuthController@status');
    Route::post('logout', 'AuthController@logout');
});

Route::group(['prefix' => 'agent'], function () {
    Route::get('/', 'AgentController@index');
    Route::post('/', 'AgentController@create');
    Route::post('/{id}/login', 'AgentController@login');
    Route::post('/{id}/disable', 'AgentController@disable');
    Route::post('/{id}/change_password', 'AgentController@changePassword');
});

Route::group(['prefix' => 'staff'], function () {
    Route::get('/', 'StaffController@index');
    Route::get('/select_options', 'StaffController@selectOptions');
    Route::post('/', 'StaffController@create');
    Route::post('/{id}/login', 'StaffController@login');
    Route::post('/{id}/disable', 'StaffController@disable');
    Route::post('/{id}/change_password', 'StaffController@changePassword');
});

Route::group(['prefix' => 'member'], function () {
    Route::get('/', 'MemberController@index');
    Route::get('/select_options', 'MemberController@selectOptions');
});

Route::group(['prefix' => 'wager'], function () {
    Route::get('/', 'WagerController@index');
});

Route::group(['prefix' => 'strategy'], function () {
    Route::get('/', 'StrategyController@index');
    Route::post('/', 'StrategyController@create');
    Route::post('/{id}', 'StrategyController@update');
    Route::post('/{id}/enable', 'StrategyController@enable');
    Route::post('/{id}/disable', 'StrategyController@disable');
});

Route::group(['prefix' => 'track'], function () {
    Route::get('/', 'TrackController@index');
});
