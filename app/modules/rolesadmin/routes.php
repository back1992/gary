<?php
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{
    // Showing the admin for the menu builder and updating the order of menu items
    Route::get('roles', array('as' => 'admin.role.show',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@getIndex'));
    Route::get('roles/{role}/show', array('as' => 'admin.role.show',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@getShow'));
    Route::get('roles/{role}/edit', array('as' => 'admin.role.edit',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@getEdit'));
    Route::post('roles/{role}/edit', array('as' => 'admin.role.edit',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@postEdit'));
    Route::get('roles/create', array('as' => 'admin.role.create',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@getCreate'));
    Route::post('roles/create', array('as' => 'admin.role.create',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@postCreate'));
    Route::get('roles/{role}/delete', array('as' => 'admin.role.delete',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@getDelete'));
    Route::post('roles/{role}/delete', array('as' => 'admin.role.delete',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@postDelete'));
    Route::get('roles/data', array('as' => 'admin.role.data',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@getData'));
    Route::post('roles/data', array('as' => 'admin.role.data',      'uses' => 'App\Modules\Rolesadmin\Controllers\RolesadminController@postData'));
      // Route::controller('roles', 'RolesadminController');
});
