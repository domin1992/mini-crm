<?php

use Illuminate\Database\Seeder;

class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('invoices')->insert([
          'client_id' => 1,
          'address_id' => 2,
          'invoice_number' => 'FV/2016/01',
          'issue_city' => 'Łódź',
          'issue_date' => '2016-05-29',
          'issue_name' => 'John Doe',
          'comment' => '',
      ]);
      DB::table('invoices')->insert([
          'client_id' => 2,
          'address_id' => 3,
          'invoice_number' => 'FV/2016/02',
          'issue_city' => 'Łódź',
          'issue_date' => '2016-06-12',
          'issue_name' => 'John Doe',
          'comment' => 'Przykładowy komentarz',
      ]);
      DB::table('invoices')->insert([
          'client_id' => 2,
          'address_id' => 3,
          'invoice_number' => 'FV/2016/03',
          'issue_city' => 'Łódź',
          'issue_date' => '2016-06-18',
          'issue_name' => 'John Doe',
          'comment' => '',
      ]);
      DB::table('invoices')->insert([
          'client_id' => 3,
          'address_id' => 4,
          'invoice_number' => 'FV/2016/04',
          'issue_city' => 'Łódź',
          'issue_date' => '2016-05-19',
          'issue_name' => 'John Doe',
          'comment' => '',
      ]);
    }
}
