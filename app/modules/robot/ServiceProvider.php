<?php namespace App\Modules\Robot;
 
class ServiceProvider extends \App\Modules\ServiceProvider {
 
    public function register()
    {
        parent::register('robot');
    }
 
    public function boot()
    {
        parent::boot('robot');
    }
 
}