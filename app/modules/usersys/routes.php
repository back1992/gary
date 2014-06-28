<?php
Route::group(array('prefix' => 'user'), function()
{
    // Showing the admin for the menu builder and updating the order of menu items
   Route::get('/',  array('as' => 'user.dashboard',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@getIndex'));
   Route::post('/',  array('as' => 'user.dashboard',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@postIndex'));
   Route::get('reset/{token}',  array('as' => 'user.reset',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@getReset'));
   Route::post('reset/{token}',  array('as' => 'user.reset',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@postReset'));
   Route::post('{user}/edit',  array('as' => 'user.edit',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@postEdit'));
   Route::get('login',  array('as' => 'user.login',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@getLogin'));
   Route::post('login',  array('as' => 'user.login',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@postLogin'));
   Route::get('settings',  array('as' => 'user.settings',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@getSettings'));
   Route::post('settings',  array('as' => 'user.settings',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@postSettings'));
   Route::get('/logout',  array('as' => 'user.logout',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@getLogout'));
   Route::get('/create',  array('as' => 'user.create',      'uses' => 'App\Modules\Usersys\Controllers\UsersysController@getCreate'));
	
});
