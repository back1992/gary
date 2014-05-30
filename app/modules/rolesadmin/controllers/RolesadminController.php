<?php namespace App\Modules\Rolesadmin\Controllers;

use Rolesadmin, Input, Redirect, View, Menu, Lang, Auth, Datatables, Validator;
use App\Modules\Rolesadmin\Models\User;
use App\Modules\Rolesadmin\Models\Post;
use App\Modules\Rolesadmin\Models\Role;
use App\Modules\Rolesadmin\Models\Permission;

class RolesadminController extends \BaseController  {


    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Role Model
     * @var Role
     */
    protected $role;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;

    /**
     * Inject the models.
     * @param User $user
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct(User $user, Role $role, Permission $permission)
    {
        // parent::__construct();
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;

        // dd($this->permission);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('usersadmin::admin/roles/title.role_management');

        // Grab all the groups
        $roles = $this->role;

        

        // Show the page
        // return View::make('rolesadmin::admin/roles/index', compact('roles', 'title'));
        return View::make('rolesadmin::admin.roles.index', compact('roles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Get all the available permissions
        $permissions = $this->permission->all();

        // Selected permissions
        $selectedPermissions = Input::old('permissions', array());

        // Title
        $title = Lang::get('usersadmin::admin/roles/title.create_a_new_role');

        // Show the page
        return View::make('rolesadmin::admin/roles/create', compact('permissions', 'selectedPermissions', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {

        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required'
            );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
        // Check if the form validates with success
        if ($validator->passes())
        {
  	    // Get the inputs, with some exceptions
            $inputs = Input::except('csrf_token');

            $this->role->name = $inputs['name'];
            $this->role->save();

                    // Get all the available permissions
            $permissions = $this->permission->all();

        // Selected permissions
            $selectedPermissions = Input::old('permissions', array());

            // Save permissions
            $this->role->perms()->sync($this->permission->preparePermissionsForSave($inputs['permissions']));

            // Was the role created?
            if ($this->role->id)
            {
                // Redirect to the new role page
                return Redirect::to('admin/roles/' . $this->role->id . '/edit')->with('success', Lang::get('usersadmin::admin/roles/messages.create.success'));
            }

            // Redirect to the new role page
            return Redirect::to('admin/roles/create')->with('error', Lang::get('usersadmin::admin/roles/messages.create.error'));

            // Redirect to the role create page
            return Redirect::to('admin/roles/create')->withInput()->with('error', Lang::get('usersadmin::admin/roles/messages.' . $error));
        }

        // Form validation failed
        return Redirect::to('admin/roles/create')->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function getShow($id)
    {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $role
     * @return Response
     */
    public function getEdit($roleId)
    {
        $roleObj = new Role;
        $role = $roleObj->getRoleById($roleId);

        if(! empty($role))
        {
            // dd($this->permission);
            $permissions = $this->permission->preparePermissionsForDisplay($role->perms()->get());
            $permissionsChunk = array_chunk($permissions, 3);
        }
        else
        {
            // dd($permissions);
            // Redirect to the roles management page
            return Redirect::to('admin/roles')->with('error', Lang::get('usersadmin::admin/roles/messages.does_not_exist'));
        }

        // Title
        $title = Lang::get('usersadmin::admin/roles/title.role_update');

        // Show the page
        return View::make('rolesadmin::admin/roles/edit', compact('role', 'permissions', 'title', 'permissionsChunk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $role
     * @return Response
     */
    public function postEdit($roleId)
    {
        // Declare the rules for the form validation
        $roleObj = new Role;
        $role = $roleObj->getRoleById($roleId);
        $input = Input::all();
        // dd($input);
        $rules = array(
            'name' => 'required'
            );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the role data
            $role->name        = Input::get('name');
            $role->perms()->sync($this->permission->preparePermissionsForSave(Input::get('permissions')));

            // Was the role updated?
            if ($role->save())
            {
                // Redirect to the role page
                return Redirect::to('admin/roles/' . $role->id . '/edit')->with('success', Lang::get('usersadmin::admin/roles/messages.update.success'));
            }
            else
            {
                // Redirect to the role page
                return Redirect::to('admin/roles/' . $role->id . '/edit')->with('error', Lang::get('usersadmin::admin/roles/messages.update.error'));
            }
        }

        // Form validation failed
        return Redirect::to('admin/roles/' . $role->id . '/edit')->withInput()->withErrors($validator);
    }


    /**
     * Remove user page.
     *
     * @param $role
     * @return Response
     */
    public function getDelete($roleId)
    {
       $roleObj = new Role;
       $role = $roleObj->getRoleById($roleId);
        // Title
       $title = Lang::get('usersadmin::admin/roles/title.role_delete');

        // Show the page
       return View::make('rolesadmin::admin/roles/delete', compact('role', 'title'));
   }

    /**
     * Remove the specified user from storage.
     *
     * @param $role
     * @internal param $id
     * @return Response
     */
    public function postDelete($roleId)
    {
     $roleObj = new Role;
     $role = $roleObj->getRoleById($roleId);
            // Was the role deleted?
     if($role->delete()) {
                // Redirect to the role management page
        return Redirect::to('admin/roles')->with('success', Lang::get('usersadmin::admin/roles/messages.delete.success'));
    }

            // There was a problem deleting the role
    return Redirect::to('admin/roles')->with('error', Lang::get('usersadmin::admin/roles/messages.delete.error'));
}

    /**
     * Show a list of all the roles formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $roles = Role::select(array('roles.id',  'roles.name', 'roles.id as users', 'roles.created_at'));

        return Datatables::of($roles)
        // ->edit_column('created_at','{{{ Carbon::now()->diffForHumans(Carbon::createFromFormat(\'Y-m-d H\', $test)) }}}')
        ->edit_column('users', '{{{ DB::table(\'assigned_roles\')->where(\'role_id\', \'=\', $id)->count()  }}}')


        ->add_column('actions', '<a href="{{{ URL::to(\'admin/roles/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'usersadmin::button.edit\') }}}</a>
            <a href="{{{ URL::to(\'admin/roles/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'usersadmin::button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}
