<?php

namespace App\Features\Admin\Http\Controllers;

use App\Features\Contact\Models\ContactMessage;
use App\Features\Shared\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $messages = ContactMessage::query();

        $total = (clone $messages)->count();
        $unread = (clone $messages)->unread()->count();
        $thisWeek = (clone $messages)->where('created_at', '>=', now()->subWeek())->count();

        $bySubject = (clone $messages)
            ->selectRaw('subject, count(*) as total')
            ->groupBy('subject')
            ->pluck('total', 'subject');

        return view('features.admin.dashboard.index', [
            'total' => $total,
            'unread' => $unread,
            'thisWeek' => $thisWeek,
            'bySubject' => $bySubject,
            'recent' => ContactMessage::query()
                ->latest()
                ->limit(6)
                ->get(),
        ]);
    }
}
