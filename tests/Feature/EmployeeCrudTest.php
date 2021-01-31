<?php

namespace Tests\Feature;

use App\Models\Employee;
use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeCrudTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $authorizedUser;
    private $unauthorizedUser;
    private $company;
    private $employee;

    public function setUp(): void
    {
        parent::setUp();
        $this->authorizedUser = User::factory()->adminUser()->create();
        $this->unauthorizedUser = User::factory()->create();
        $this->company = Company::factory()->create();
        $this->employee = Employee::factory()->create(['company_id' => $this->company->id]);
    }

    public function testCrudUserNotAuthorized()
    {
        $this->actingAs($this->unauthorizedUser)
            ->get(route('companies.employees.index', ['company' => $this->company->id]))
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->get(route('companies.employees.create', ['company' => $this->company->id]))
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->post(route('companies.employees.store', ['company' => $this->company->id]), [])
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->get(route('companies.employees.show', [
                'company' => $this->company->id,
                'employee' => $this->employee->id
            ]))
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->get(route('companies.employees.edit', [
                'company' => $this->company->id,
                'employee' => $this->employee->id
            ]))
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->put(route('companies.employees.update', [
                'company' => $this->company->id,
                'employee' => $this->employee->id
            ]), [])
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->delete(route('companies.employees.destroy', [
                'company' => $this->company->id,
                'employee' => $this->employee->id
            ]))
            ->assertStatus(403);
    }

    public function testCreateSuccessful()
    {

        $params = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber
        ];

        $this->actingAs($this->authorizedUser)
            ->post(route('companies.employees.store', ['company' => $this->company->id]), $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals('The employee was successfully created.', session('status'));
        $this->assertDatabaseHas('employees', [
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name']
        ]);

    }

    public function testUpdateSuccessful()
    {

        $params = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber
        ];

        $this->actingAs($this->authorizedUser)
            ->put(route('companies.employees.update', [
                'company' => $this->company->id,
                'employee' => $this->employee->id
                ]), $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals('The employee was successfully updated.', session('status'));
        $this->assertDatabaseHas('employees', [
                'first_name' => $params['first_name'],
                'last_name' => $params['last_name']
             ]);
    }

    public function testDeleteSuccessful()
    {
        $this->actingAs($this->authorizedUser)
            ->delete(route('companies.employees.destroy', [
                'company' => $this->company->id,
                'employee' => $this->employee->id
                ]))
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals('The employee was successfully deleted.', session('status'));
        $this->assertDatabaseCount('employees', 0);
    }
}
