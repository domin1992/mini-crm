<?php

use Illuminate\Database\Seeder;

class ContractSignMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contract_sign_methods')->insert([
            'name' => 'SMS',
            'slug' => 'sms',
        ]);
        DB::table('contract_sign_methods')->insert([
            'name' => 'Email',
            'slug' => 'email',
        ]);
    }
}
