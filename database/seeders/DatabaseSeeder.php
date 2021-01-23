<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->adminUser()->create();
        Company::factory(50)->create();
        Company::all()->each(function (Company $company) {
            Employee::factory(random_int(5, 20))->create([
                'company_id' => $company->id
            ]);
        });
    }
}
