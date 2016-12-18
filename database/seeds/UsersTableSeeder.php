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
          'firstname' => 'John',
          'lastname' => 'Doe',
          'email' => 'test@test.com',
          'password' => bcrypt('abc123'),
          'admin' => 1,
      ]);
      DB::table('users')->insert([
          'firstname' => 'Jan',
          'lastname' => 'Kowalski',
          'email' => 'jan@test.com',
          'password' => bcrypt('abc123'),
          'admin' => 0,
      ]);
    }
}
