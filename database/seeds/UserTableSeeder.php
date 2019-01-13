<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
    	$admin->name = 'Admin Jos';
    	$admin->email = 'admin@gmail.com';
    	$admin->password = bcrypt('rahasia');
    	$admin->save();
    }
}
