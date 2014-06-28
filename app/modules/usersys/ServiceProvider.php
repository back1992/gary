<?php namespace App\Modules\Usersys;
 
class ServiceProvider extends \App\Modules\ServiceProvider {
 
    public function register()
    {
        parent::register('usersys');
    }
 
    public function boot()
    {
        parent::boot('usersys');
    }
 
}