<?php namespace App\Modules\Usersadmin;
 
class ServiceProvider extends \App\Modules\ServiceProvider {
 
    public function register()
    {
        parent::register('usersadmin');
    }
 
    public function boot()
    {
        parent::boot('usersadmin');
    }
 
}