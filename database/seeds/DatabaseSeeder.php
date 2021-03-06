<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(InvoiceTableSeeder::class);
        $this->call(InvoicePositionTableSeeder::class);
        $this->call(TaxTableSeeder::class);
        $this->call(OwnerTableSeeder::class);
        $this->call(UserPermissionsTableSeeder::class);
        $this->call(RecurringPaymentsTableSeeder::class);
        $this->call(PaymentMethodsSeeder::class);
        $this->call(ContractSignMethodsTableSeeder::class);
    }
}
