<?php namespace App\Modules\Navmenu\Seeds;

class NavmenusTableSeeder extends \Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		\DB::table('navmenus')->truncate();

		\DB::table('navmenus')->insert(array (
			0 => 
			array (
				'id' => '1',
				'parent_id' => '9',
				'title' => 'admin menu',
				'label' => 'admin menu',
				'url' => '/admin/menu',
				'order' => '0',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 07:02:41',
				'updated_at' => '2014-05-08 09:52:03',
				),
			1 => 
			array (
				'id' => '2',
				'parent_id' => '1',
				'title' => 't1',
				'label' => 't1',
				'url' => 't1',
				'order' => '1',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 07:09:32',
				'updated_at' => '2014-05-08 09:51:59',
				),
			2 => 
			array (
				'id' => '3',
				'parent_id' => '0',
				'title' => 'm2',
				'label' => 'm2',
				'url' => 'm2',
				'order' => '3',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 07:09:44',
				'updated_at' => '2014-05-08 09:50:47',
				),
			3 => 
			array (
				'id' => '5',
				'parent_id' => '0',
				'title' => 'ok',
				'label' => 'ok',
				'url' => 'ok',
				'order' => '4',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 08:32:17',
				'updated_at' => '2014-05-08 09:50:47',
				),
			4 => 
			array (
				'id' => '6',
				'parent_id' => '5',
				'title' => 'kypay',
				'label' => 'kypay',
				'url' => 'kypay',
				'order' => '0',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 08:32:33',
				'updated_at' => '2014-05-08 08:32:51',
				),
			5 => 
			array (
				'id' => '7',
				'parent_id' => '0',
				'title' => 'user',
				'label' => 'uesr',
				'url' => 'user',
				'order' => '5',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 08:32:48',
				'updated_at' => '2014-05-08 09:50:47',
				),
			6 => 
			array (
				'id' => '8',
				'parent_id' => '0',
				'title' => 'home',
				'label' => 'Home',
				'url' => '/',
				'order' => '0',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 09:49:16',
				'updated_at' => '2014-05-08 09:50:47',
				),
			7 => 
			array (
				'id' => '9',
				'parent_id' => '0',
				'title' => 'system',
				'label' => 'system',
				'url' => '/system/phpinfo',
				'order' => '1',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 09:50:08',
				'updated_at' => '2014-05-08 09:50:47',
				),
			8 => 
			array (
				'id' => '10',
				'parent_id' => '9',
				'title' => 'phpinfo',
				'label' => 'phpinfo',
				'url' => '/system/phpinfo',
				'order' => '1',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 09:51:48',
				'updated_at' => '2014-05-08 09:52:03',
				),
			9 => 
			array (
				'id' => '11',
				'parent_id' => '0',
				'title' => 'roles',
				'label' => 'roles',
				'url' => '/admin/roles',
				'order' => '6',
				'is_seperator' => '0',
				'created_at' => '2014-05-08 10:12:09',
				'updated_at' => '2014-05-08 10:18:04',
				),
			));
\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
}

}
