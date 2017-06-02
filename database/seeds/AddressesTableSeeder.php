<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('addresses')->insert([
          'client_id' => 1,
          'name' => 'Siedziba',
          'street' => 'Świętego Marcina 12',
          'city' => 'Poznań',
          'postcode' => '44-896',
          'country' => 'Polska',
      ]);
      DB::table('addresses')->insert([
          'client_id' => 1,
          'name' => 'Biuro',
          'street' => 'Warszawska 12/16 lok. 12',
          'city' => 'Gdańsk',
          'postcode' => '89-999',
          'country' => 'Polska',
      ]);
      DB::table('addresses')->insert([
          'client_id' => 2,
          'name' => 'Biuro',
          'street' => 'Lumumby 56',
          'city' => 'Warszawa',
          'postcode' => '00-258',
          'country' => 'Polska',
      ]);
      DB::table('addresses')->insert([
          'client_id' => 3,
          'name' => 'Siedziba',
          'street' => 'Pomorska 2 m. 1',
          'city' => 'Łódź',
          'postcode' => '91-555',
          'country' => 'Polska',
      ]);
    }
}
