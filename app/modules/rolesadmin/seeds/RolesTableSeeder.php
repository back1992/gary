<?php namespace App\Modules\Rolesadmin\Seeds;
use DB, Hash, Config, DateTime, Seeder;
use App\Modules\Rolesadmin\Models\User;
use App\Modules\Rolesadmin\Models\Post;
use App\Modules\Rolesadmin\Models\Role;

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();
        // \DB::table('roles')->truncate();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();

        $commentRole = new Role;
        $commentRole->name = 'comment';
        $commentRole->save();

        $managerRole = new Role;
        $managerRole->name = 'Manager';
        $managerRole->save();

        $hrRole = new Role;
        $hrRole->name = 'Human Resource';
        $hrRole->save();

        $operationRole = new Role;
        $operationRole->name = 'Operation';
        $operationRole->save();

        $salesRole = new Role;
        $salesRole->name = 'Sales';
        $salesRole->save();

        $cashierRole = new Role;
        $cashierRole->name = 'Cashier';
        $cashierRole->save();

        $customRole = new Role;
        $customRole->name = 'Custom Service';
        $customRole->save();

/*
        $userObj = new User;
        $user = $userObj->getUserByUsername( 'admin' );
        // $user = User::where('username','=','admin')->first();
        dd($userObj);
        $user->attachRole( $adminRole );*/

        $user = User::where('username','=','user')->first();
        $user->attachRole( $commentRole );

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );
        
        $user = User::where('username','=','manager')->first();
        $user->attachRole( $managerRole );
        
        $user = User::where('username','=','hr')->first();
        $user->attachRole( $hrRole );
        
        $user = User::where('username','=','operation')->first();
        $user->attachRole( $operationRole );
        
        $user = User::where('username','=','sales')->first();
        $user->attachRole( $salesRole );
        
        $user = User::where('username','=','cashier')->first();
        $user->attachRole( $cashierRole );
        
        $user = User::where('username','=','custom')->first();
        $user->attachRole( $customRole );
    }

}
