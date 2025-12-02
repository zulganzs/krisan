<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_announcement()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.announcements.store'), [
            'title' => 'Important Update',
            'content' => 'System maintenance scheduled.',
            'is_active' => 'on',
        ]);

        $response->assertRedirect(route('admin.announcements.index'));
        $this->assertDatabaseHas('announcements', [
            'title' => 'Important Update',
            'content' => 'System maintenance scheduled.',
            'is_active' => true,
        ]);
    }

    public function test_user_can_see_active_announcement()
    {
        $user = User::factory()->create();
        Announcement::create([
            'title' => 'Public Notice',
            'content' => 'Water supply interruption.',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Public Notice');
        $response->assertSee('Water supply interruption.');
    }

    public function test_user_cannot_see_inactive_announcement()
    {
        $user = User::factory()->create();
        Announcement::create([
            'title' => 'Hidden Notice',
            'content' => 'This should not be seen.',
            'is_active' => false,
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertDontSee('Hidden Notice');
    }
}
