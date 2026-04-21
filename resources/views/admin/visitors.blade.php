<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Logs</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="admin-shell text-slate-900 min-h-screen">
<style>
    .admin-shell {
        background: #e9edf3;
        padding: 0.75rem;
    }
    .admin-frame {
        width: 100%;
        margin: 0 auto;
        background: #f8fafd;
        border: 1px solid #d9e1ef;
        border-radius: 26px;
        box-shadow: 0 24px 44px rgba(15, 23, 42, 0.08);
        display: grid;
        grid-template-columns: 78px 1fr;
        min-height: calc(100vh - 3.5rem);
        overflow: hidden;
    }
    .admin-sidebar {
        background: #f2f5fb;
        border-right: 1px solid #dde5f2;
        padding: 1.1rem 0.8rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.9rem;
    }
    .admin-side-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        border: 1px solid #dde4f2;
        background: #ffffff;
        color: #596580;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .admin-side-icon.active {
        background: #ecebff;
        color: #3c2de2;
        border-color: #d9d5ff;
    }
    .admin-main {
        padding: 1.6rem;
    }
    .admin-topbar {
        background: #ffffff;
        border: 1px solid #e0e8f5;
        border-radius: 18px;
        padding: 1rem 1.1rem;
    }
    @media (max-width: 1024px) {
        .admin-frame {
            grid-template-columns: 1fr;
        }
        .admin-sidebar {
            flex-direction: row;
            justify-content: center;
            border-right: 0;
            border-bottom: 1px solid #dde5f2;
        }
    }
</style>
<div class="admin-frame">
    <aside class="admin-sidebar">
        <span class="admin-side-icon"><i class="fa-solid fa-wallet"></i></span>
        <span class="admin-side-icon active"><i class="fa-solid fa-chart-line"></i></span>
        <span class="admin-side-icon"><i class="fa-solid fa-gear"></i></span>
        <span class="admin-side-icon"><i class="fa-solid fa-bell"></i></span>
    </aside>
<div class="admin-main">
    <div class="admin-topbar">
    <div class="flex flex-wrap gap-3 items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold">Portfolio Visitor Logs</h1>
            <p class="text-sm text-slate-600 mt-1">Protected admin page for traffic monitoring.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow">
                Expense Dashboard
            </a>
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button type="submit" class="inline-flex items-center rounded-lg bg-slate-900 text-white px-4 py-2 text-sm font-medium">
                    Logout
                </button>
            </form>
        </div>
    </div>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mt-6">
        <div class="rounded-xl bg-white p-4 shadow">
            <p class="text-xs uppercase text-slate-500">Total Visits</p>
            <p class="text-2xl font-semibold">{{ number_format($summary['total_visits']) }}</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow">
            <p class="text-xs uppercase text-slate-500">Today</p>
            <p class="text-2xl font-semibold">{{ number_format($summary['today_visits']) }}</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow">
            <p class="text-xs uppercase text-slate-500">Unique IPs</p>
            <p class="text-2xl font-semibold">{{ number_format($summary['unique_ips']) }}</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow">
            <p class="text-xs uppercase text-slate-500">Mobile Visits</p>
            <p class="text-2xl font-semibold">{{ number_format($summary['mobile_visits']) }}</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow">
            <p class="text-xs uppercase text-slate-500">Bot Visits</p>
            <p class="text-2xl font-semibold">{{ number_format($summary['bot_visits']) }}</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow">
            <p class="text-xs uppercase text-slate-500">Geo Tracked</p>
            <p class="text-2xl font-semibold">{{ number_format($summary['tracked_locations']) }}</p>
        </div>
    </div>

    <div class="mt-8 rounded-xl bg-white shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-left">
                <tr>
                    <th class="px-4 py-3 font-semibold">Date & Time</th>
                    <th class="px-4 py-3 font-semibold">Path</th>
                    <th class="px-4 py-3 font-semibold">UTM</th>
                    <th class="px-4 py-3 font-semibold">IP Address</th>
                    <th class="px-4 py-3 font-semibold">Location</th>
                    <th class="px-4 py-3 font-semibold">Device</th>
                    <th class="px-4 py-3 font-semibold">Browser / OS</th>
                    <th class="px-4 py-3 font-semibold">Bot</th>
                    <th class="px-4 py-3 font-semibold">Referer</th>
                    <th class="px-4 py-3 font-semibold">User Agent</th>
                </tr>
                </thead>
                <tbody>
                @forelse($logs as $log)
                    <tr class="border-t border-slate-100 align-top">
                        <td class="px-4 py-3 whitespace-nowrap">{{ optional($log->visited_at)->format('Y-m-d H:i:s') }}</td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-slate-800">{{ $log->path }}</p>
                            @if($log->query_string)
                                <p class="text-xs text-slate-500 break-all mt-1">?{{ $log->query_string }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="space-y-1 min-w-44">
                                <p class="text-xs"><span class="text-slate-500">src:</span> {{ $log->utm_source ?: '-' }}</p>
                                <p class="text-xs"><span class="text-slate-500">med:</span> {{ $log->utm_medium ?: '-' }}</p>
                                <p class="text-xs"><span class="text-slate-500">camp:</span> {{ $log->utm_campaign ?: '-' }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">{{ $log->ip_address ?: '-' }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $log->city ?: '-' }}@if($log->city && ($log->region || $log->country)), @endif{{ $log->region ?: '' }}@if($log->region && $log->country), @endif{{ $log->country ?: '' }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p>{{ ucfirst($log->device_type ?: 'unknown') }}</p>
                            <p class="text-xs text-slate-500">{{ $log->device_model ?: '-' }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p>{{ $log->browser ?: '-' }}</p>
                            <p class="text-xs text-slate-500">{{ $log->os ?: '-' }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($log->is_bot)
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-amber-100 text-amber-900">Yes</span>
                            @else
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-emerald-100 text-emerald-900">No</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 break-all max-w-sm">{{ $log->referer ?: '-' }}</td>
                        <td class="px-4 py-3 break-all max-w-md">{{ $log->user_agent ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-4 py-8 text-center text-slate-500">No visitor data yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 border-t border-slate-100">
            {{ $logs->links() }}
        </div>
    </div>
</div>
</div>
</body>
</html>
