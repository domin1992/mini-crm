<?php

use Illuminate\Database\Seeder;

class OwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            'name' => 'Company name',
            'vat_number' => '7894561230',
            'nbrn' => '1458965885',
            'email' => 'test@test.com',
            'phone' => '555896987',
            'website' => 'www.example.com',
            'postcode' => '00-589',
            'city' => 'Warszawa',
            'street' => 'Rozenta 13',
            'country' => 'Polska',
            'bank_name' => 'Bank name',
            'bank_account_number' => '00 0000 0000 0000 0000 0000 0000',
        ]);
    }
}
