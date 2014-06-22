<?php
Route::group(array('prefix' => 'clcurl'), function()
{
    // Showing the admin for the menu builder and updating the order of menu items
   Route::get('/',  array('as' => 'clcurl.dashboard',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@getIndex'));
   Route::get('/readpdf',  array('as' => 'clcurl.readpdf',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@readPdf'));
   Route::get('/readtext',  array('as' => 'clcurl.readtext',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@readText'));
   Route::get('/pdf2text',  array('as' => 'clcurl.pdf2text',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@pdf2text'));
   Route::get('/pdf2html',  array('as' => 'clcurl.pdf2html',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@pdf2html'));
   Route::get('/snoopy',  array('as' => 'clcurl.snoopy',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@getSnoopy'));
   Route::get('/query',  array('as' => 'clcurl.query',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@getQuery'));
   Route::get('/pdfparse',  array('as' => 'clcurl.pdfparse',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@pdfParse'));
   Route::get('/phpinfo',  array('as' => 'clcurl.phpinfo',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@phpinfo'));
   Route::get('/getpages',  array('as' => 'clcurl.getpages',      'uses' => 'App\Modules\Clcurl\Controllers\ClcurlController@getpages'));

});
