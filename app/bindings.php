<?php

// use App\Modules\Content\Models\Entry;
// /*
// |--------------------------------------------------------------------------
// | Application & Route Filters
// |--------------------------------------------------------------------------
// |
// | Below you will find the "before" and "after" events for the application
// | which may be used to do any work before or after a request into your
// | application. Here you may also register your custom route filters.
// |
// */
// /*$navmenu = new Navmenu;
// // dd($navmenu->exists);
// dd($navmenu);
// if ($navmenu->exists) {*/

// 	Menu::handler('topmenu', array('class' => 'nav nav-pills pull-right'))->hydrate(function()
// 	{
// 		return Navmenu::orderBy('order')->get();
// 	},
// 	function($children, $item)
// 	{
// 		if($item->is_seperator) 
// 		{
// 			dd($item);
// 			$children->raw('')->onItem()->addClass('seperator');
// 		}
// 		else
// 		{
// 			$children->add($item->url, $item->label, Menu::items($item->as));
// 		}
// 	});

// 	Menu::handler('topmenu')->getItemsAtDepth(0)->map(function($item)
// 	{
// 		if($item->hasChildren())
// 		{
// 			$item->addClass('dropdown');

// 			$item->getChildren()
// 			->addClass('dropdown-menu');

// 			$item->getContent()
// 			->addClass('dropdown-toggle')
// 			->dataToggle('dropdown')
// 			->nest(' <b class="caret"></b>');
// 		}
// 	});

// 	Menu::handler('main')->hydrate(function()
// 	{
// 		return Navmenu::orderBy('order')->get();
// 	},
// 	function($children, $item)
// 	{
// 		      //           print "<pre>";
//         // print_r(json_decode($item->getAttribute('roles')));
//         // print "</pre>";
// 		// if(strlen($item->getAttribute('roles')) == 0) {
// 			$children->add($item->url, $item->label, Menu::items($item->as));
// 		// }
// 		// 	dd(get_class_methods($item));
// 		// dd(get_object_vars($item));
// 		// dd(count($item->roles));
// 		// if( is_array( $item->roles ) )
// 	/*	if( is_null( $item->roles ) ) dd($item);
// 		if( is_string( $item->roles ) ) dd($item);
// 		if( is_array( $item->roles ) ) dd($item);
// 		print_r($item->roles);
// 		dd($item->roles);*/
// 		// if( false )

// 		// if( is_string( $item->roles ) ) 
// 		// {
// 		// 	$item->addClass('hidden');
// 		// 	// dd($item);
// 		// } 
// 		// else
// 		// {
// 		// if($item->getAttribute('roles'))
		
// 		// }
// 	});

// 	Menu::handler('main')
// 	->addClass('navmenu nav navbar-nav');

// 	Menu::handler('main')
// 	->getItemsByContentType('Menu\Items\Contents\Link')
// 	->map(function($item)
// 	{
// 		// print_r($item->roles);
// 		// dd($item);
// 		if($item->isActive() && $item->hasChildren())
// 		{
// 			$item->addClass('active');
// 		}

// 		if($item->getContent()->getUrl() == 'home')
// 		{
// 			$item->addClass('is-home');
// 		}
// 	});
// 	// dd(get_class_methods(Menu::handler('main')));
// 	// dd(get_object_vars(Menu::handler('main')));

// 	// dd(Menu::handler('main')->getItemsByContentType('Menu\Items\Contents\Link'));
// 	// dd(Menu::handler('main')->getItemsByContentType('Menu\Items\Contents\Link'));
// 	// dd(Menu::handler('main')->getMenuObjects());
// 	Menu::handler('main')->getItemsByContentType('Menu\Items\Contents\Link')
// 	// ->map(function($item)
// 	->map(function($item)
// 	{
// 		// dd($item->value);
// 		// print_r($item->value);
// /*		dd($item);
// 		dd(get_class_methods($item));
// 		dd(get_object_vars($item));
// 		dd($item->name);*/
// 		if($item->isActive() && $item->hasChildren())
// 		{
// 			$item->addClass('active');
// 		}

// 		if($item->getContent()->getUrl() == 'home')
// 		{
// 			$item->addClass('is-home');
// 		}
// 	});
	
// // }
// /*	array_map(function($item)
// 	{
// 		// dd($item->value);
// 		// print_r($item->value);
// 		dd($item);
// 		dd(get_class_methods($item));
// 		dd(get_object_vars($item));
// 		dd($item->name);
// 		if($item->isActive() && $item->hasChildren())
// 		{
// 			$item->addClass('active');
// 		}
// 	}, Menu::handler('main')->getMenuObjects());*/

//         // Menu::handler('sidebar')->hydrate(function()
//         // {
//         //     return Navmenu::orderBy('order')->get();
//         // },
//         // function($children, $item)
//         // {
//         //     // dd($item);
//         //     // $children->add($item->url, $item->label, $item->id, Menu::items($item->as));
//         // //         print "<pre>";
//         // // print_r($item->getAttribute('roles'));
//         // // print "</pre>";
//         //     // if(strlen($item->getAttribute('roles')) == 0) {
//         //         $children->add($item->url, $item->label, Menu::items($item->as));
//         //     // }
//         //     // print_r($item->roles);
//         // });

//         // Menu::handler('sidebar')
//         // ->addClass('navmenu nav navbar-nav');

//         // Menu::handler('sidebar')
//         // ->getItemsByContentType('Menu\Items\Contents\Link')
//         // ->map(function($item)
//         // {
//         // 	// dd($item);
//         //     if($item->isActive() && $item->hasChildren())
//         //     {
//         //         $item->addClass('active');
//         //     }

//         //     if($item->getContent()->getUrl() == 'home')
//         //     {
//         //         $item->addClass('is-home');
//         //     }
//         // });