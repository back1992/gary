<?php namespace App\Modules\System\Controllers;

use System, Input, Redirect, View;
use App\Modules\Rolesadmin\Models\User;

/**
 * Systementication controller
 * @author Boris Strahija <bstrahija@gmail.com>
 */
class SystemController extends \BaseController {

	/**
	 * Display login screen
	 * @return View
	 */
	public function getPhpinfo()
	{
		return View::make('system::phpinfo');
	}


	public function getIndex()
	{



		$userObj = new User;
		$user = $userObj->currentUser();

		return View::make('system::dashboard', compact('user'));
	}

}
