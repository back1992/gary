<?php namespace App\Modules\Rolesadmin;

class RolesadminServiceProvider extends \Illuminate\Support\ServiceProvider {

	public function register()
	{
		\Log::debug("RolesadminServiceProvider registered");

				// Register facades
		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Rolesadmin', 'App\Modules\Rolesadmin\Models\Rolesadmin');
			$loader->alias('AssignedRoles', 'App\Modules\Rolesadmin\Models\AssignedRoles');
			$loader->alias('Comment', 'App\Modules\Rolesadmin\Models\Comment');
			$loader->alias('Permission', 'App\Modules\Rolesadmin\Models\Permission');
			$loader->alias('Post', 'App\Modules\Rolesadmin\Models\Post');
			$loader->alias('Role', 'App\Modules\Rolesadmin\Models\Role');
			$loader->alias('User', 'App\Modules\Rolesadmin\Models\User');
		});
	}

}
