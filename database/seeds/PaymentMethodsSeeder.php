<?php

use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'name' => 'Gotówka',
            'module_name' => 'cash'
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Przelew',
            'module_name' => 'bank_transfer'
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'PayU',
            'module_name' => 'payu'
        ]);
    }
}
