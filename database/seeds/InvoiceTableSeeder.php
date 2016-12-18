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
          'invoice_number' => 'FV/2016/05/01',
          'issue_city' => 'Łódź',
          'issue_date' => '2016-05-29',
          'issue_name' => 'John Doe',
          'payment_date' => '2016-06-12',
          'comment' => '',
      ]);
      DB::table('invoices')->insert([
          'client_id' => 2,
          'address_id' => 3,
          'invoice_number' => 'FV/2016/06/01',
          'issue_city' => 'Łódź',
          'issue_date' => '2016-06-12',
          'issue_name' => 'John Doe',
          'payment_date' => '2016-06-26',
          'comment' => 'Przykładowy komentarz',
      ]);
      DB::table('invoices')->insert([
          'client_id' => 2,
          'address_id' => 3,
          'invoice_number' => 'FV/2016/06/02',
          'issue_city' => 'Łódź',
          'issue_date' => '2016-06-18',
          'issue_name' => 'John Doe',
          'payment_date' => '2016-07-02',
          'comment' => '',
      ]);
      DB::table('invoices')->insert([
          'client_id' => 3,
          'address_id' => 4,
          'invoice_number' => 'FV/2016/05/02',
          'issue_city' => 'Łódź',
          'issue_date' => '2016-05-19',
          'issue_name' => 'John Doe',
          'payment_date' => '2016-06-02',
          'comment' => '',
      ]);
    }
}
