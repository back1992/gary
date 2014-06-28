<?php namespace App\Modules\System;

class SystemServiceProvider extends \Illuminate\Support\ServiceProvider {

	public function register()
	{
		\Log::debug("SystemServiceProvider registered");
	}

}
