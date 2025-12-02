<?php

namespace Tests\Feature\Admin;

use App\Models\Tariff;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TariffTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_tariffs_page()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get(route('admin.tariffs.index'));

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_view_tariffs_page()
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get(route('admin.tariffs.index'));

        $response->assertStatus(403); // Assuming middleware redirects or aborts
    }

    public function test_admin_can_create_tariff()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.tariffs.store'), [
            'tier_name' => 'Test Tier',
            'min_usage' => 0,
            'max_usage' => 10,
            'price_per_m3' => 5000,
        ]);

        $response->assertRedirect(route('admin.tariffs.index'));
        $this->assertDatabaseHas('tariffs', ['tier_name' => 'Test Tier']);
    }

    public function test_admin_can_update_tariff()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $tariff = Tariff::create([
            'tier_name' => 'Old Tier',
            'min_usage' => 0,
            'max_usage' => 10,
            'price_per_m3' => 5000,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.tariffs.update', $tariff), [
            'tier_name' => 'Updated Tier',
            'min_usage' => 0,
            'max_usage' => 10,
            'price_per_m3' => 6000,
        ]);

        $response->assertRedirect(route('admin.tariffs.index'));
        $this->assertDatabaseHas('tariffs', ['tier_name' => 'Updated Tier']);
    }

    public function test_admin_can_delete_tariff()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $tariff = Tariff::create([
            'tier_name' => 'To Delete',
            'min_usage' => 0,
            'max_usage' => 10,
            'price_per_m3' => 5000,
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.tariffs.destroy', $tariff));

        $response->assertRedirect(route('admin.tariffs.index'));
        $this->assertDatabaseMissing('tariffs', ['id' => $tariff->id]);
    }
}
