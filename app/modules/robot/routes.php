<?php
Route::group(array('prefix' => 'robot'), function()
{
    // Showing the admin for the menu builder and updating the order of menu items
   Route::get('/',  array('as' => 'robot.dashboard',      'uses' => 'App\Modules\Robot\Controllers\RobotController@getIndex'));
   Route::get('/index2',  array('as' => 'robot.dashboard',      'uses' => 'App\Modules\Robot\Controllers\RobotController@getIndex2'));
   Route::get('/index3',  array('as' => 'robot.dashboard',      'uses' => 'App\Modules\Robot\Controllers\RobotController@getIndex3'));
   Route::get('/webbot',  array('as' => 'robot.webBot',      'uses' => 'App\Modules\Robot\Controllers\RobotController@webBot'));
   Route::post('/',  array('as' => 'robot.dashboard',      'uses' => 'App\Modules\Robot\Controllers\RobotController@postIndex'));
   Route::get('reset/{token}',  array('as' => 'robot.reset',      'uses' => 'App\Modules\Robot\Controllers\RobotController@getReset'));
   Route::post('reset/{token}',  array('as' => 'robot.reset',      'uses' => 'App\Modules\Robot\Controllers\RobotController@postReset'));
   Route::post('{robot}/edit',  array('as' => 'robot.edit',      'uses' => 'App\Modules\Robot\Controllers\RobotController@postEdit'));
   Route::get('login',  array('as' => 'robot.login',      'uses' => 'App\Modules\Robot\Controllers\RobotController@getLogin'));
   Route::post('login',  array('as' => 'robot.login',      'uses' => 'App\Modules\Robot\Controllers\RobotController@postLogin'));
   Route::get('settings',  array('as' => 'robot.settings',      'uses' => 'App\Modules\Robot\Controllers\RobotController@getSettings'));
   Route::post('settings',  array('as' => 'robot.settings',      'uses' => 'App\Modules\Robot\Controllers\RobotController@postSettings'));
   Route::get('/logout',  array('as' => 'robot.logout',      'uses' => 'App\Modules\Robot\Controllers\RobotController@getLogout'));
   Route::get('/create',  array('as' => 'robot.create',      'uses' => 'App\Modules\Robot\Controllers\RobotController@getCreate'));
   Route::get('/pdf',  array('as' => 'robot.pdf',      'uses' => 'App\Modules\Robot\Controllers\RobotController@getPdf'));
	
});
