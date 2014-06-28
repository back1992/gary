<?php namespace App\Modules\Codetidy;
 
class ServiceProvider extends \App\Modules\ServiceProvider {
 
    public function register()
    {
        parent::register('codetidy');
    }
 
    public function boot()
    {
        parent::boot('codetidy');
    }
 
}