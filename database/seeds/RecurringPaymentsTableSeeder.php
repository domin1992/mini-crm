<?php

use Illuminate\Database\Seeder;

class RecurringPaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('recurring_payments')->insert([
          'client_id' => 1,
          'name' => 'Serwer',
          'description' => '',
          'period_count' => 1,
          'period' => 4,
          'period_start' => '2016-10-16 00:00:00',
          'price' => 160.00,
      ]);
      DB::table('recurring_payments')->insert([
          'client_id' => 2,
          'name' => 'Serwer',
          'description' => '',
          'period_count' => 1,
          'period' => 4,
          'period_start' => '2016-10-12 00:00:00',
          'price' => 140.00,
      ]);
      DB::table('recurring_payments')->insert([
          'client_id' => 2,
          'name' => 'Domena',
          'description' => 'domana.xyz',
          'period_count' => 2,
          'period' => 4,
          'period_start' => '2016-12-11 00:00:00',
          'price' => 99.99,
      ]);
      DB::table('recurring_payments')->insert([
          'client_id' => 3,
          'name' => 'Serwer',
          'description' => '',
          'period_count' => 1,
          'period' => 3,
          'period_start' => '2016-12-01 00:00:00',
          'price' => 12.00,
      ]);
    }
}
