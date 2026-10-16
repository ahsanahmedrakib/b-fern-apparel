<?php

namespace App\Features\Contact\Services;

use App\Features\Contact\Mail\InquiryReceived;
use App\Features\Contact\Models\ContactMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactService
{
    /**
     * Persist an inquiry and notify the team. A mail failure is logged
     * instead of thrown so the message is never lost.
     *
     * @param  array<string, mixed>  $data
     */
    public function submit(array $data): ContactMessage
    {
        $contactMessage = ContactMessage::create($data);

        try {
            Mail::to(config('bfern.contact.email'))->send(new InquiryReceived($contactMessage));
        } catch (Throwable $exception) {
            Log::warning('Contact inquiry notification failed to send.', [
                'contact_message_id' => $contactMessage->id,
                'exception' => $exception->getMessage(),
            ]);
        }

        return $contactMessage;
    }
}
