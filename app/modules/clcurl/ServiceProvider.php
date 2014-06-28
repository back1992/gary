<?php namespace App\Modules\Clcurl;
 
class ServiceProvider extends \App\Modules\ServiceProvider {
 
    public function register()
    {
        parent::register('clcurl');
    }
 
    public function boot()
    {
        parent::boot('clcurl');
    }
 
}