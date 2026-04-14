<?php

namespace App\Http\Controllers;

use App\Models\VisitorLog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VisitorLogController extends Controller
{
    public function index(Request $request): View
    {
        $logs = VisitorLog::query()
            ->latest('visited_at')
            ->paginate(50)
            ->appends($request->query());

        $summary = [
            'total_visits' => VisitorLog::count(),
            'today_visits' => VisitorLog::whereDate('visited_at', today())->count(),
            'unique_ips' => VisitorLog::query()->distinct('ip_address')->count('ip_address'),
            'mobile_visits' => VisitorLog::query()->where('device_type', 'mobile')->count(),
            'bot_visits' => VisitorLog::query()->where('is_bot', true)->count(),
            'tracked_locations' => VisitorLog::query()->whereNotNull('country')->count(),
        ];

        return view('admin.visitors', [
            'logs' => $logs,
            'summary' => $summary,
        ]);
    }
}
