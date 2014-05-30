<?php namespace App\Modules\Rolesadmin\Facades;

use Illuminate\Support\Facades\Facade;

class PostFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return new \App\Modules\Rolesadmin\Models\Post; }

}
