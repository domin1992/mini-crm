<?php

use Illuminate\Database\Seeder;

class UserPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('permissions')->insert([
          'user_id' => 2,
          'controller' => 'App\Http\Controllers\CompanyController',
      ]);
      DB::table('permissions')->insert([
          'user_id' => 2,
          'controller' => 'App\Http\Controllers\ClientController',
      ]);
    }
}
