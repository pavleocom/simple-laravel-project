<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeRedirectTest extends TestCase
{
    public function testHomePageRedirectsToCompaniesIndexPage()
    {
        $response = $this->get('/');
        $response->assertRedirect(route('companies.index'));
    }
}
