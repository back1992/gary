<?php namespace App\Modules\Clcurl\Facades;

use Illuminate\Support\Facades\Facade;

class PdfFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return new \App\Modules\Content\Models\Pdf; }

}
