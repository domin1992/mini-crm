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
          'firstname' => 'Dominik',
          'lastname' => 'Nowak',
          'email' => 'domin1204@gmail.com',
          'password' => bcrypt('domin84265'),
      ]);
    }
}
