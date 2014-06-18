<?php
Route::group(array('prefix' => 'codetidy'), function()
{
    // Showing the admin for the menu builder and updating the order of menu items
   Route::get('/',  array('as' => 'codetidy.dashboard',      'uses' => 'App\Modules\Codetidy\Controllers\CodetidyController@getIndex'));
});
