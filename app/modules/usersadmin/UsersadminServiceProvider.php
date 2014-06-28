<?php namespace App\Modules\Usersadmin;

class UsersadminServiceProvider extends \Illuminate\Support\ServiceProvider {

	public function register()
	{
		\Log::debug("UsersadminServiceProvider registered");

				// Register facades
		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Usersadmin', 'App\Modules\Usersadmin\Models\Usersadmin');
		});
	}

}
