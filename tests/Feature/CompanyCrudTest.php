<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\UploadedFile;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyCrudTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $authorizedUser;
    private $unauthorizedUser;
    private $company;

    public function setUp(): void
    {
        parent::setUp();
        $this->authorizedUser = User::factory()->adminUser()->create();
        $this->unauthorizedUser = User::factory()->create();
        $this->company = Company::factory()->create();
    }

    public function testCrudUserNotAuthorized()
    {
        $this->actingAs($this->unauthorizedUser)
            ->get(route('companies.index'))
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->get(route('companies.create'))
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->post(route('companies.store'), [])
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->get(route('companies.show', ['company' => $this->company->id]))
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->get(route('companies.edit', ['company' => $this->company->id]))
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->put(route('companies.update', ['company' => $this->company->id]), [])
            ->assertStatus(403);

        $this->actingAs($this->unauthorizedUser)
            ->delete(route('companies.destroy', ['company' => $this->company->id]))
            ->assertStatus(403);
    }

    public function testCreateSuccessful()
    {

        $params = [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'website' => $this->faker->domainName,
            'logo' => UploadedFile::fake()->image('logo.jpg', 150, 150)->size(100)
        ];

        $this->actingAs($this->authorizedUser)
            ->post(route('companies.store'), $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals('The company was successfully created.', session('status'));
        $this->assertDatabaseHas('companies', ['name' => $params['name']]);

    }

    public function testUpdateSuccessful()
    {
        $file = UploadedFile::fake()->image('logo.jpg', 150, 150)->size(100);

        $params = [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'website' => $this->faker->domainName,
            'logo' => $file
        ];

        $this->actingAs($this->authorizedUser)
            ->put(route('companies.update', ['company' => $this->company->id]), $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals('The company information was successfully updated.', session('status'));
        $this->assertDatabaseHas('companies', [
             'name' => $params['name'],
             'email' => $params['email'],
             'website' => $params['website']
             ]);
    }

    public function testDeleteSuccessful()
    {
        $this->actingAs($this->authorizedUser)
            ->delete(route('companies.destroy', ['company' => $this->company->id]))
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals('The company was successfully deleted.', session('status'));
        $this->assertDatabaseCount('companies', 0);
    }

}
