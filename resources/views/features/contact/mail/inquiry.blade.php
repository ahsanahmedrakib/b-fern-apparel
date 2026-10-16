<x-mail::message>
# New website inquiry

**Name:** {{ $contactMessage->name }}
**Email:** {{ $contactMessage->email }}
@if ($contactMessage->company)
**Company:** {{ $contactMessage->company }}
@endif
@if ($contactMessage->phone)
**Phone:** {{ $contactMessage->phone }}
@endif
**Topic:** {{ config('bfern.contact.subjects')[$contactMessage->subject] ?? $contactMessage->subject }}

**Message**

{{ $contactMessage->message }}

<x-mail::button :url="'mailto:'.$contactMessage->email">
Reply to {{ $contactMessage->name }}
</x-mail::button>

Received {{ $contactMessage->created_at->format('M j, Y g:i A') }}.
</x-mail::message>
