<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('clients')->insert([
          'company' => 'DRUTEX',
          'nip' => '7894561230',
          'email' => str_random(10).'@gmail.com',
      ]);
      DB::table('clients')->insert([
          'company' => 'Grav',
          'nip' => '1234567890',
          'email' => str_random(10).'@gmail.com',
      ]);
      DB::table('clients')->insert([
          'company' => 'Absolution',
          'nip' => '8523697410',
          'email' => str_random(10).'@gmail.com',
      ]);
      DB::table('clients')->insert([
          'company' => 'Birenta',
          'nip' => '9637418520',
          'email' => str_random(10).'@gmail.com',
      ]);
    }
}
