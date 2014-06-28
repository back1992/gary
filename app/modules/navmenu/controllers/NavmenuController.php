<?php namespace App\Modules\Navmenu\Controllers;

use Input, Redirect, View, Menu;
use App\Modules\Navmenu\Models\Navmenu;
use App\Modules\Rolesadmin\Models\Role;
use App\Modules\Rolesadmin\Models\User;

/**
 * Navmenuentication controller
 * @author Boris Strahija <bstrahija@gmail.com>
 */
class NavmenuController extends \BaseController {

	// protected $layout = 'admin.layouts.default';

	public function getIndex()
	{	
		$items 	= Navmenu::orderBy('order')->get();

		$menu 	= new Navmenu;
		// dd($menu);
		$menu   = $menu->getHTML($items);

		$mode = 'create';

		$roleObj = new Role;
		$roles = $roleObj->all();
		$selectedRoles = Input::old('roles', array());

		return View::make('navmenu::admin.menu.builder', compact('items', 'menu', 'roles', 'selectedRoles', 'mode'));
	}

	public function getNameIndex($menuName)
	{	
		$userObj = new User;
		$user = $userObj->currentUser();
		// dd($menuName);
		$roleObj = new Role;
		$roles = $roleObj->all()->toArray();
		// dd(Menu::handler('main')->render());

		return View::make('navmenu::nameIndex', compact('user', 'menuName', 'roles'));
	}

	public function getEdit($id)
	{	
		$item = Navmenu::find($id);
		$roleObj = new Role;
		$roles = $roleObj->all();
		$selectedRoles = json_decode($item->roles);
		$mode = 'create';
		(count($selectedRoles) == 0) ? $selectedRoles = array('role' => null ) : $selectedRoles ;
		// dd($item);
		// $this->layout->content = View::make('navmenu::admin.menu.edit', compact('roles', 'item', 'selectedRoles', 'mode'));
		return View::make('navmenu::admin.menu.edit', compact('roles', 'item', 'selectedRoles', 'mode'));
	}

	public function postEdit($id)
	{	
		$item = Navmenu::find($id);
		$item->title 	= e(Input::get('title','untitled'));
		$item->label 	= e(Input::get('label',''));	
		$item->url 		= e(Input::get('url',''));	
		$item->roles 		= json_encode(Input::get('roles'));	
		// dd($item->roles);

		$item->save();
		$selectedRoles = json_decode($item->roles);
		// dd($selectedRoles);
		return Redirect::to("admin/menu/edit/{$id}")->with('selectedRoles', $selectedRoles);
	}

	// AJAX Reordering function
	public function postIndex()
	{	
		$source       = e(Input::get('source'));
		$destination  = e(Input::get('destination',0));

		$item             = Navmenu::find($source);
		$item->parent_id  = $destination;  
		$item->save();

		$ordering       = json_decode(Input::get('order'));
		$rootOrdering   = json_decode(Input::get('rootOrder'));

		if($ordering){
			foreach($ordering as $order=>$item_id){
				if($itemToOrder = Navmenu::find($item_id)){
					$itemToOrder->order = $order;
					$itemToOrder->save();
				}
			}
		} else {
			foreach($rootOrdering as $order=>$item_id){
				if($itemToOrder = Navmenu::find($item_id)){
					$itemToOrder->order = $order;
					$itemToOrder->save();
				}
			}
		}

		return 'ok ';
	}

	public function postNew()
	{
		// Create a new menu item and save it
		$item = new Navmenu;

		$item->title 	= e(Input::get('title','untitled'));
		$item->label 	= e(Input::get('label',''));	
		$item->url 		= e(Input::get('url',''));	
		$item->order 	= Navmenu::max('order')+1;

		$item->save();

		return Redirect::to('admin/menu');
	}

	public function postDelete()
	{
		$id = Input::get('delete_id');
		// Find all items with the parent_id of this one and reset the parent_id to zero
		$items = Navmenu::where('parent_id', $id)->get()->each(function($item)
		{
			$item->parent_id = 0;  
			$item->save();  
		});

		// Find and delete the item that the user requested to be deleted
		$item = Navmenu::find($id);
		$item->delete();

		return Redirect::to('admin/menu');
	}

}
