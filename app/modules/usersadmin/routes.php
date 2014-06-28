<?php
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{
    // Showing the admin for the menu builder and updating the order of menu items
    Route::get('users', array('as' => 'admin.user.show',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@getIndex'));
    Route::get('users/{user}/show', array('as' => 'admin.user.show',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@getShow'));
    Route::get('users/{user}/edit', array('as' => 'admin.user.edit',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@getEdit'));
    Route::post('users/{user}/edit', array('as' => 'admin.user.edit',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@postEdit'));
    Route::get('users/{user}/delete', array('as' => 'admin.user.delete',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@getDelete'));
    Route::post('users/{user}/delete', array('as' => 'admin.user.delete',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@postDelete'));
     Route::get('users/create', array('as' => 'admin.user.create',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@getCreate'));
    Route::post('users/create', array('as' => 'admin.user.create',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@postCreate'));
      Route::get('users/data', array('as' => 'admin.user.data',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@getData'));
    // Route::post('users/{user}/create', array('as' => 'admin.user.create',      'uses' => 'App\Modules\Usersadmin\Controllers\UsersadminController@postCreate'));
      // Route::controller('users', 'UsersadminController');
});
