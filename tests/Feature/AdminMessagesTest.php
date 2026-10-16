<?php

namespace Tests\Feature;

use App\Features\Contact\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMessagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_view_the_message_inbox(): void
    {
        $this->get(route('admin.messages.index'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_an_admin_can_view_the_inbox_of_contact_messages(): void
    {
        $message = ContactMessage::factory()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('admin.messages.index'))
            ->assertOk()
            ->assertSee($message->name);
    }

    public function test_the_inbox_can_be_filtered_by_search_term(): void
    {
        $match = ContactMessage::factory()->create(['name' => 'Findable Buyer']);
        $other = ContactMessage::factory()->create(['name' => 'Someone Else']);

        $this->actingAs(User::factory()->create())
            ->get(route('admin.messages.index', ['search' => 'Findable']))
            ->assertOk()
            ->assertSee($match->name)
            ->assertDontSee($other->name);
    }

    public function test_the_inbox_can_be_filtered_to_unread_messages_only(): void
    {
        $unread = ContactMessage::factory()->create(['read_at' => null]);
        $read = ContactMessage::factory()->read()->create();

        $this->actingAs(User::factory()->create())
            ->get(route('admin.messages.index', ['unread_only' => 1]))
            ->assertOk()
            ->assertSee($unread->name)
            ->assertDontSee($read->name);
    }

    public function test_viewing_a_message_marks_it_as_read(): void
    {
        $message = ContactMessage::factory()->create(['read_at' => null]);

        $this->actingAs(User::factory()->create())
            ->get(route('admin.messages.show', $message))
            ->assertOk();

        $this->assertNotNull($message->fresh()->read_at);
    }

    public function test_an_admin_can_toggle_a_message_between_read_and_unread(): void
    {
        $message = ContactMessage::factory()->create(['read_at' => null]);
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->post(route('admin.messages.read', $message))
            ->assertRedirect();

        $this->assertNotNull($message->fresh()->read_at);

        $this->actingAs($admin)
            ->post(route('admin.messages.read', $message))
            ->assertRedirect();

        $this->assertNull($message->fresh()->read_at);
    }

    public function test_an_admin_can_delete_a_message(): void
    {
        $message = ContactMessage::factory()->create();

        $this->actingAs(User::factory()->create())
            ->delete(route('admin.messages.destroy', $message))
            ->assertRedirect(route('admin.messages.index'));

        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
    }
}
