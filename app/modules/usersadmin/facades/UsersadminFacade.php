<?php namespace App\Modules\Usersadmin\Facades;

use Illuminate\Support\Facades\Facade;

class UsersadminFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return new \App\Modules\Usersadmin\Models\Usersadmin; }

}
