<?php namespace App\Modules\Rolesadmin;
 
class ServiceProvider extends \App\Modules\ServiceProvider {
 
    public function register()
    {
        parent::register('rolesadmin');
    }
 
    public function boot()
    {
        parent::boot('rolesadmin');
    }
 
}