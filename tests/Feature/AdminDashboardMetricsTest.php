<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AdminDashboardMetricsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_returns_metrics_and_activity()
    {
        // Seed base data
        $this->seed();

        // Create some additional activity
        Service::factory()->create(['name' => 'Extra Service']);
        Testimonial::factory()->create(['author' => 'Extra Author']);

        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertInertia(fn (Assert $page) => $page
            ->component('Admin/Dashboard')
            ->has('stats', fn (Assert $stats) => $stats
                ->where('users', fn ($value) => $value >= 1)
                ->where('services', fn ($value) => $value >= 1)
                ->where('testimonials', fn ($value) => $value >= 1)
                ->has('hero_active')
                ->where('company_profile_exists', true)
                ->where('contact_info_exists', true)
            )
            ->has('activity')
            ->has('activity.0.type')
        );
    }
}
