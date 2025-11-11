<?php

namespace Tests\Feature;

use App\Models\HeroSection;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_contains_seeded_content(): void
    {
        HeroSection::factory()->create(['title' => 'Test Hero', 'is_active' => true]);
        Service::factory()->create(['name' => 'Service A']);
        Testimonial::factory()->create(['author' => 'Tester', 'content' => 'Bagus']);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Test Hero');
        $response->assertSee('Service A');
        $response->assertSee('Bagus');
    }
}
