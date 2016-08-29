<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('employees')->insert([
          'firstname' => 'Jolanta',
          'lastname' => 'Baran',
          'title' => 'Account Manager',
          'email' => str_random(10).'@gmail.com',
          'phone' => '789456123',
      ]);
      DB::table('employees')->insert([
          'firstname' => 'Krzysztof',
          'lastname' => 'Witkowski',
          'title' => 'Web Developer',
          'email' => str_random(10).'@gmail.com',
          'phone' => '987654321',
      ]);
      DB::table('employees')->insert([
          'firstname' => 'Tadeusz',
          'lastname' => 'Dudek',
          'title' => 'Graphics',
          'email' => str_random(10).'@gmail.com',
          'phone' => '741963258',
      ]);
      DB::table('employees')->insert([
          'firstname' => 'Natalia',
          'lastname' => 'Grabowska',
          'title' => 'Secretary',
          'email' => str_random(10).'@gmail.com',
          'phone' => '753869421',
      ]);
      DB::table('employees')->insert([
          'firstname' => 'Wiesława',
          'lastname' => 'Wróblewska',
          'title' => 'Programmer',
          'email' => str_random(10).'@gmail.com',
          'phone' => '931786245',
      ]);
    }
}
