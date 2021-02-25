<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Misho',
            'email' => 'mikheil.akopov@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 1,
            'avatar' => '',
            'nickname' => '',
            'email_verified_at' => now(),
        ]);
    }
}
