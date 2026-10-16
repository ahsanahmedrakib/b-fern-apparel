<?php

namespace App\Features\Contact\Http\Controllers;

use App\Features\Contact\Http\Requests\StoreContactRequest;
use App\Features\Contact\Services\ContactService;
use App\Features\Shared\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('features.contact.index', [
            'subjects' => config('bfern.contact.subjects'),
        ]);
    }

    public function store(StoreContactRequest $request, ContactService $service): RedirectResponse
    {
        if ($request->filled('website')) {
            return $this->confirmation();
        }

        $service->submit($request->validated());

        return $this->confirmation();
    }

    protected function confirmation(): RedirectResponse
    {
        return redirect()
            ->route('contact.index')
            ->with('status', 'Thank you for reaching out. Your message has been sent and our team will follow up shortly.');
    }
}
