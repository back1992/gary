<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
// View::composer('categories', function($view)
View::composer('partials.sidebar.categories', function($view)
{
	$user = new User;
	$userRoles = $user->currentUser()->currentRoleIds();
	// dd($roles);

	Menu::handler('sidebar')->hydrate(function()
	{
		return Navmenu::orderBy('order')->get();
	},
	function($children, $item)
	{
            // dd($item);
            // $children->add($item->url, $item->label, $item->id, Menu::items($item->as));
        //         print "<pre>";
		// $user = new User;


		// dd($user->hasRole('menu'));
		// dd($item->as);

        // print "</pre>";
		// if(is_array($navRoles) && (count(array_intersect($userRoles, $navRoles)) !== 0)) {
		$children->add($item->url, $item->label, Menu::items($item->as), array('rolesLink' => $item->roles), array('rolesItem' => $item->roles));

			// $item->addClass('hidden');
		// }
            // print_r($item->roles);
	});

	Menu::handler('sidebar')
	->addClass('navmenu nav navbar-nav');

	Menu::handler('sidebar')
	->getItemsByContentType('Menu\Items\Contents\Link')
	->map(function($item)
	{
/*		// dd(get_class_methods($item));
		// dd($item->getAttribute('rolesItem'));
		// print_r($item->getAttribute('roles'));
		$user = Confide::user();
		$userRoles = $user->currentUser()->currentRoleIds();
		$navRoles = json_decode($item->getAttribute('rolesItem'));
			// dd($userRoles);
			// dd($item->getOption());
		// if(is_array($navRoles) && (count(array_intersect($userRoles, $navRoles)) !== 0)) {
		if(is_array($navRoles)) {
			$item->addClass('hidden');

			// dd($item->addClass('hidden'));
		}
		if($item->isActive() && $item->hasChildren())
		{
			$item->addClass('active');
		}

		// if($item->getContent()->getUrl() == 'home')
		// {
		// 	$item->addClass('is-home');
		// }*/

		if($item->isActive() && $item->hasChildren())
		{
			$item->addClass('active');
		}

		if($item->getContent()->getUrl() == 'home')
		{
			$item->addClass('is-home');
		}
	});


	Menu::handler('sidebar')
	->getItemsAtDepth(0)
	->map(function($item)
	{
		// dd(get_class_methods($item));
		// dd($item->getAttributes());
				$user = Confide::user();
		$userRoles = $user->currentUser()->currentRoleIds();
		$navRoles = json_decode($item->getAttribute('rolesItem'));
			// dd($userRoles);
			// dd($item->getOption());
		if(!is_array($navRoles) || (count(array_intersect($userRoles, $navRoles)) == 0)) {
		// if(is_array($navRoles)) {
			$item->addClass('hidden');

			// dd($item->addClass('hidden'));
		}
	});



	$view->with('sideNav', Menu::handler('sidebar')->render());
});