<?php

use Illuminate\Database\Seeder;

class InvoicePositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('invoice_positions')->insert([
          'invoice_id' => 1,
          'name' => 'Projekt strony internetowej',
          'measure_unit' => 'szt',
          'quantity' => 1,
          'price_tax_excl' => 289.32,
          'tax_id' => 1,
      ]);
      DB::table('invoice_positions')->insert([
          'invoice_id' => 1,
          'name' => 'Budowa strony internetowej',
          'measure_unit' => 'szt',
          'quantity' => 1,
          'price_tax_excl' => 765.15,
          'tax_id' => 1,
      ]);
      DB::table('invoice_positions')->insert([
          'invoice_id' => 2,
          'name' => 'Projekt strony internetowej',
          'measure_unit' => 'szt',
          'quantity' => 1,
          'price_tax_excl' => 213.00,
          'tax_id' => 1,
      ]);
      DB::table('invoice_positions')->insert([
          'invoice_id' => 2,
          'name' => 'Budowa strony internetowej',
          'measure_unit' => 'szt',
          'quantity' => 1,
          'price_tax_excl' => 879.55,
          'tax_id' => 1,
      ]);
      DB::table('invoice_positions')->insert([
          'invoice_id' => 3,
          'name' => 'Wykonanie strony internetowej',
          'measure_unit' => 'szt',
          'quantity' => 1,
          'price_tax_excl' => 1896.78,
          'tax_id' => 1,
      ]);
      DB::table('invoice_positions')->insert([
          'invoice_id' => 4,
          'name' => 'Wykonanie strony internetowej',
          'measure_unit' => 'szt',
          'quantity' => 1,
          'price_tax_excl' => 2358.00,
          'tax_id' => 1,
      ]);
    }
}
