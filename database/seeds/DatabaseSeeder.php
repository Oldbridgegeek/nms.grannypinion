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
    	DB::table('users')->insert([
            'firstname' => 'User',
            'lastname' => "One",
            'email' => 'user_one@example.com',
            'verified'=>1,
            'password' => bcrypt('123123'),
        ]);
        DB::table('users')->insert([
            'firstname' => 'User',
            'lastname' => "Two",
            'email' => 'user_two@example.com',
            'verified'=>1,
            'password' => bcrypt('123123'),
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
