<?php
Route::group(array('prefix' => 'admin/menu'), function()
{
    // Showing the admin for the menu builder and updating the order of menu items
    Route::get('/', array('as' => 'admin.menu',      'uses' => 'App\Modules\Navmenu\Controllers\NavmenuController@getIndex'));
    Route::post('/', array('as' => 'admin.menu',      'uses' => 'App\Modules\Navmenu\Controllers\NavmenuController@postIndex'));
    Route::post('new', array('as' => 'admin.menu.new',      'uses' => 'App\Modules\Navmenu\Controllers\NavmenuController@postNew'));
    Route::post('delete', array('as' => 'admin.menu.delete',      'uses' => 'App\Modules\Navmenu\Controllers\NavmenuController@postDelete'));
    Route::get('edit/{id}', array('as' => 'admin.menu.edit',      'uses' => 'App\Modules\Navmenu\Controllers\NavmenuController@getEdit'));
    Route::post('edit/{id}', array('as' => 'admin.menu.edit',      'uses' => 'App\Modules\Navmenu\Controllers\NavmenuController@postEdit'));
});

Route::get('/menu/{menuName}', array('as' => 'menu.menuname',      'uses' => 'App\Modules\Navmenu\Controllers\NavmenuController@getNameIndex'));