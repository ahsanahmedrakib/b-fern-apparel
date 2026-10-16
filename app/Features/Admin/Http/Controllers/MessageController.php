<?php

namespace App\Features\Admin\Http\Controllers;

use App\Features\Contact\Models\ContactMessage;
use App\Features\Shared\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request): View
    {
        $messages = ContactMessage::query()
            ->when($request->string('search')->trim()->value(), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->when($request->string('subject')->trim()->value(), fn ($query, $subject) => $query->where('subject', $subject))
            ->when($request->boolean('unread_only'), fn ($query) => $query->unread())
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('features.admin.messages.index', [
            'messages' => $messages,
            'subjects' => config('bfern.contact.subjects'),
            'unreadMessages' => ContactMessage::query()->unread()->count(),
            'filters' => [
                'search' => $request->string('search')->value(),
                'subject' => $request->string('subject')->value(),
                'unread_only' => $request->boolean('unread_only'),
            ],
        ]);
    }

    public function show(ContactMessage $contactMessage): View
    {
        $contactMessage->markAsRead();

        return view('features.admin.messages.show', [
            'message' => $contactMessage,
        ]);
    }

    public function toggleRead(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->isRead()
            ? $contactMessage->markAsUnread()
            : $contactMessage->markAsRead();

        return back()->with('status', 'Message updated.');
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('status', 'Message deleted.');
    }
}
