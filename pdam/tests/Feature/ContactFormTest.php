<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_can_be_submitted()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('contact.store'), [
            'subject' => 'Test Subject',
            'category' => 'leak_report',
            'message' => 'This is a test message.',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('support_tickets', [
            'subject' => 'Test Subject',
            'category' => 'leak_report',
            'message' => 'This is a test message.',
            'user_id' => $user->id,
        ]);
    }

    public function test_contact_form_validation()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('contact.store'), [
            'subject' => '',
            'category' => 'invalid_category',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['subject', 'category', 'message']);
    }
}
