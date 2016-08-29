<?php

use Illuminate\Database\Seeder;

class TaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('taxes')->insert([
          'display' => '23%',
          'value' => '0.23',
      ]);
    }
}
