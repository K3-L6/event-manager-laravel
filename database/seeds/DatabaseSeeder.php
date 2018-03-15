<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'title' => 'Sample Event',
            'title_font' => 'Aclonica',
            'title_size' => '20',
            'title_color' => 'white',

            'description' => 'Description Sample',
            'description_font' => 'Aclonica',
            'description_size' => '5',
            'description_color' => 'white',

            'background' => 'sample.jpg',
            'status' => 1,
        ]);



    	DB::table('roles')->insert([
    	    'name' => 'Super User',
    	    'description' => 'this role has all access in all module',
    	]);

    	

    	DB::table('accesses')->insert([
    	    'module' => 'administrator',
    	    'role_id' => '1',
    	]);

    	DB::table('accesses')->insert([
    	    'module' => 'exhibitor',
    	    'role_id' => '1',
    	]);

    	DB::table('accesses')->insert([
    	    'module' => 'registrator',
    	    'role_id' => '1',
    	]);




    	DB::table('users')->insert([
    	    'lastname' => 'lising',
    	    // 'middlename' => '',
            'firstname' => 'ken',
    	    'email' => 'superadmin@gmail.com',
    	    'password' => bcrypt('password'),
    	    'avatar' => 'noimg.jpg',
    	    'role_id' => 1,
    	]);
    }
}
