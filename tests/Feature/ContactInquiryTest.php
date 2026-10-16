<?php

namespace Tests\Feature;

use App\Features\Contact\Mail\InquiryReceived;
use App\Features\Contact\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactInquiryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, mixed>
     */
    private function validPayload(): array
    {
        return [
            'name' => 'Jordan Blake',
            'email' => 'jordan@example.com',
            'company' => 'Blake Retail Group',
            'phone' => '555-0100',
            'subject' => 'buying',
            'message' => 'We are looking for knit and woven programs for the upcoming season.',
        ];
    }

    public function test_it_stores_a_contact_inquiry_and_notifies_the_team(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), $this->validPayload())
            ->assertRedirect(route('contact.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Jordan Blake',
            'email' => 'jordan@example.com',
            'subject' => 'buying',
        ]);

        Mail::assertSent(InquiryReceived::class, function (InquiryReceived $mail) {
            return $mail->hasTo(config('bfern.contact.email'))
                && $mail->contactMessage->email === 'jordan@example.com';
        });
    }

    public function test_it_validates_required_contact_fields(): void
    {
        Mail::fake();

        $this->from(route('contact.index'))
            ->post(route('contact.store'), [])
            ->assertRedirect(route('contact.index'))
            ->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

        $this->assertSame(0, ContactMessage::count());
        Mail::assertNothingSent();
    }

    public function test_it_rejects_an_unknown_subject(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), [
            ...$this->validPayload(),
            'subject' => 'not-a-real-subject',
        ])->assertSessionHasErrors('subject');

        $this->assertSame(0, ContactMessage::count());
    }

    public function test_it_silently_discards_submissions_that_trip_the_honeypot(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), [
            ...$this->validPayload(),
            'name' => 'Spam Bot',
            'website' => 'https://spam.example.com',
        ])->assertRedirect(route('contact.index'));

        $this->assertSame(0, ContactMessage::count());
        Mail::assertNothingSent();
    }
}
