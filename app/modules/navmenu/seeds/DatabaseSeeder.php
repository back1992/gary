<?php namespace App\Modules\Navmenu\Seeds;

use Eloquent, Str;
use App\Modules\Navmenu\Seeds\NavmenusTableSeeder;

class DatabaseSeeder extends \Seeder {

    public function run()
    {
        Eloquent::unguard();

        // Add calls to Seeders here
        // $tmp = new UsersTableSeeder;
        // dd($tmp);
        $this->call('App\Modules\Navmenu\Seeds\NavmenusTableSeeder');
    }

}