<x-mail::message>
# New website inquiry

**Name:** {{ $contactMessage->name }}
@if ($contactMessage->email)
**Email:** {{ $contactMessage->email }}
@endif
@if ($contactMessage->company)
**Company:** {{ $contactMessage->company }}
@endif
@if ($contactMessage->phone)
**Phone:** {{ $contactMessage->phone }}
@endif
**Topic:** {{ config('bfern.contact.subjects')[$contactMessage->subject] ?? $contactMessage->subject }}

**Message**

{{ $contactMessage->message }}

@if ($contactMessage->email)
<x-mail::button :url="'mailto:'.$contactMessage->email">
Reply to {{ $contactMessage->name }}
</x-mail::button>
@endif

Received {{ $contactMessage->created_at->format('M j, Y g:i A') }}.
</x-mail::message>
