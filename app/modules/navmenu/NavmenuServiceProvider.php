<?php namespace App\Modules\Navmenu;

class NavmenuServiceProvider extends \Illuminate\Support\ServiceProvider {

	public function register()
	{
		\Log::debug("NavmenuServiceProvider registered");

				// Register facades
		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Navmenu', 'App\Modules\Navmenu\Models\Navmenu');
		});
	}

}
