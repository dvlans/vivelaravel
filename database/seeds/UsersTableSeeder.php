<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Cristian',
            'email' => 'cristian.labadie@gmail.com',
            'password' => bcrypt('ae18ab6cef'),
            'admin' => true

        ]);
    }
}
