<?php namespace App\Modules\Rolesadmin\Seeds;

use Eloquent, Str;
use App\Modules\Rolesadmin\Models\User;
use App\Modules\Rolesadmin\Models\Posts;
use App\Modules\Rolesadmin\Models\Comments;
use App\Modules\Rolesadmin\Models\Role;
use App\Modules\Rolesadmin\Models\Permissions;
use App\Modules\Rolesadmin\Seeds\UsersTableSeeder;
use App\Modules\Rolesadmin\Seeds\PostsTableSeeder;
use App\Modules\Rolesadmin\Seeds\RolesTableSeeder;
use App\Modules\Rolesadmin\Seeds\PermissionsTableSeeder;

class DatabaseSeeder extends \Seeder {

    public function run()
    {
        Eloquent::unguard();

        // Add calls to Seeders here
        // $tmp = new UsersTableSeeder;
        // dd($tmp);
        $this->call('App\Modules\Rolesadmin\Seeds\UsersTableSeeder');
        $this->call('App\Modules\Rolesadmin\Seeds\PostsTableSeeder');
        $this->call('App\Modules\Rolesadmin\Seeds\CommentsTableSeeder');
        $this->call('App\Modules\Rolesadmin\Seeds\RolesTableSeeder');
        $this->call('App\Modules\Rolesadmin\Seeds\PermissionsTableSeeder');
    }

}