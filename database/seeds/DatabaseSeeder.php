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
            'title_size' => '40',

            'description' => 'Description Sample',
            'description_font' => 'Aclonica',
            'description_size' => '15',

            'background' => 'sample.jpg',
            'status' => 1,
        ]);

        // DB::table('guests')->insert([
        //     'email' => 'ken@gmail.com',

        //     'firstname' => 'ken',
        //     'middlename' => 'robles',
        //     'lastname' => 'lising',

        //     'designation' => 'ojt',
        //     'companyname' => 'golden aurum',
        //     'officeaddress' => 'sample address',
            
        //     'mobilenumber' => '09999999999',
        //     'officetelnumber' => '1111111',

        //     'type' => 1,
        // ]);

        // DB::table('guests')->insert([
        //     'email' => 'christian@gmail.com',

        //     'firstname' => 'christian',
        //     'lastname' => 'montemayor',

        //     'designation' => 'ojt',
        //     'companyname' => 'golden aurum',
        //     'officeaddress' => 'sample address',
            
        //     'mobilenumber' => '09999999999',
        //     'officetelnumber' => '1111111',

        //     'type' => 1,
        // ]);

        // DB::table('guests')->insert([
        //     'email' => 'erd@gmail.com',

        //     'firstname' => 'erd',
        //     'lastname' => 'manalo',

        //     'designation' => 'ojt',
        //     'companyname' => 'golden aurum',
        //     'officeaddress' => 'sample address',
            
        //     'mobilenumber' => '09999999999',
        //     'officetelnumber' => '1111111',

        //     'type' => 2,
        // ]);

    	DB::table('roles')->insert([
    	    'name' => 'makapangyarihan',
    	    'description' => 'this role has all access in all module',
    	]);

    	DB::table('roles')->insert([
    	    'name' => 'administrator',
    	    'description' => 'this role has access for administrator module',
    	]);

    	DB::table('roles')->insert([
    	    'name' => 'exhibitor',
    	    'description' => 'this role has access for exhibitor module',
    	]);

    	DB::table('roles')->insert([
    	    'name' => 'registrator',
    	    'description' => 'this role has access for registrator module',
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

    	DB::table('accesses')->insert([
    	    'module' => 'administrator',
    	    'role_id' => '2',
    	]);

    	DB::table('accesses')->insert([
    	    'module' => 'exhibitor',
    	    'role_id' => '3',
    	]);

    	DB::table('accesses')->insert([
    	    'module' => 'registrator',
    	    'role_id' => '4',
    	]);



    	DB::table('users')->insert([
    	    'lastname' => 'Sari',
    	    'firstname' => 'Dorofei',
    	    'email' => 'superadmin@gmail.com',
    	    'password' => bcrypt('password'),
    	    'avatar' => 'noimg.jpg',
    	    'role_id' => 1,
    	]);

    	DB::table('users')->insert([
    	    'lastname' => 'Dalton',
    	    'firstname' => 'Waylon',
    	    'email' => 'admin@gmail.com',
    	    'password' => bcrypt('password'),
    	    'avatar' => 'noimg.jpg',
    	    'role_id' => 2,
    	]);

    	DB::table('users')->insert([
    	    'lastname' => 'Henderson',
    	    'firstname' => 'Justine',
    	    'email' => 'exhibitor@gmail.com',
    	    'password' => bcrypt('password'),
    	    'avatar' => 'noimg.jpg',
    	    'role_id' => 3,
    	]);

    	DB::table('users')->insert([
    	    'lastname' => 'Lang',
    	    'firstname' => 'Abdullah',
    	    'email' => 'registrator@gmail.com',
    	    'password' => bcrypt('password'),
    	    'avatar' => 'noimg.jpg',
    	    'role_id' => 4,
    	]);
    }
}
