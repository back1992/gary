<?php namespace App\Modules\Codetidy\Controllers;
use Confide, Redirect, View, Input, Lang, Auth, Session, Menu;
use App\Modules\Rolesadmin\Models\User;
use App\Modules\Navmenu\Models\Navmenu;
use App\Modules\Codetidy\Models\Request;
use App\Modules\Codetidy\Models\Response;
use App\Modules\Codetidy\Models\WebBot\WebBot;

class CodetidyController extends \BaseController {
    // public $restful = true;  

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param User $user
     */
    public function __construct(User $user)
    {
        // parent::__construct();
        $this->user = $user;
        set_time_limit(0);

        // dd($this->user->hasrole('de'));
    }

    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex()
    {
        // Show the page
        $tidy = new \PHP_Beautifier();
        dd($tidy);
        return View::make('codetidy::index', compact('user'));
    }

}