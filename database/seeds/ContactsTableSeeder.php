<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('contacts')->insert([
          'client_id' => 1,
          'firstname' => 'Zbigniew',
          'lastname' => 'Kozłowski',
          'title' => 'CEO',
          'email' => str_random(10).'@gmail.com',
          'phone' => '456789123',
      ]);
      DB::table('contacts')->insert([
          'client_id' => 1,
          'firstname' => 'Danuta',
          'lastname' => 'Sikorska',
          'title' => 'Sekretarka',
          'email' => str_random(10).'@gmail.com',
          'phone' => '852369741',
      ]);
      DB::table('contacts')->insert([
          'client_id' => 2,
          'firstname' => 'Mateusz',
          'lastname' => 'Majewski',
          'title' => 'Account manager',
          'email' => str_random(10).'@gmail.com',
          'phone' => '321564879',
      ]);
      DB::table('contacts')->insert([
          'client_id' => 4,
          'firstname' => 'Mirosław',
          'lastname' => 'Pawlak',
          'title' => 'Project manager',
          'email' => str_random(10).'@gmail.com',
          'phone' => '789456123',
      ]);
    }
}
