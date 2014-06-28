<?php
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{
    // Showing the admin for the menu builder and updating the order of menu items
   Route::get('/',  array('as' => 'admin.dashboard',      'uses' => 'App\Modules\System\Controllers\SystemController@getIndex'));
   Route::get('system',  array('as' => 'admin.system',      'uses' => 'App\Modules\System\Controllers\SystemController@getIndex'));
   Route::get('/system/phpinfo',  array('as' => 'admin.system.phpinfo',      'uses' => 'App\Modules\System\Controllers\SystemController@getPhpinfo'));
	
});


