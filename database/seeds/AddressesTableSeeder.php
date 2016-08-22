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
          'street' => 'Świętego Marcina',
          'street_number' => '12',
          'city' => 'Poznań',
          'postcode' => '44-896',
          'country' => 'Polska',
      ]);
      DB::table('addresses')->insert([
          'client_id' => 1,
          'name' => 'Biuro',
          'street' => 'Warszawska',
          'street_number' => '12/16',
          'apartment_number' => '32',
          'city' => 'Gdańsk',
          'postcode' => '89-999',
          'country' => 'Polska',
      ]);
      DB::table('addresses')->insert([
          'client_id' => 2,
          'name' => 'Biuro',
          'street' => 'Lumumby',
          'street_number' => '56',
          'city' => 'Warszawa',
          'postcode' => '00-258',
          'country' => 'Polska',
      ]);
      DB::table('addresses')->insert([
          'client_id' => 3,
          'name' => 'Siedziba',
          'street' => 'Pomorska',
          'street_number' => '2',
          'apartment_number' => '12',
          'city' => 'Łódź',
          'postcode' => '91-555',
          'country' => 'Polska',
      ]);
    }
}
