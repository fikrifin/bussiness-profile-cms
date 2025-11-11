<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_and_delete_service(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->post(route('admin.services.store'), [
                'name' => 'Test Service',
                'description' => 'Desc',
                'icon' => null,
                'sort_order' => 1,
            ])->assertRedirect();

        $service = Service::where('name', 'Test Service')->first();
        $this->assertNotNull($service);

        $this->actingAs($admin)
            ->delete(route('admin.services.destroy', $service))
            ->assertRedirect();

        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }
}
