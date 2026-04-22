<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Expense Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ @filemtime(public_path('css/app.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .panel {
            border: 1px solid #dbe3ef;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        }
        .soft-input {
            border: 1px solid #cfd9e8;
            background: #f8fbff;
        }
        .soft-input:focus {
            outline: none;
            border-color: #64748b;
            box-shadow: 0 0 0 3px rgba(100, 116, 139, 0.15);
            background: #ffffff;
        }
        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            border-radius: 0.6rem;
            background: linear-gradient(120deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            font-weight: 600;
            border: 1px solid #0f172a;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .primary-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.24);
        }
        .success-btn {
            background: linear-gradient(120deg, #047857 0%, #059669 100%);
            border-color: #047857;
            box-shadow: 0 8px 18px rgba(5, 150, 105, 0.22);
        }
        .action-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.9rem;
            height: 1.9rem;
            border-radius: 0.5rem;
            border: 1px solid #dbe1ea;
            background: #ffffff;
            color: #334155;
            transition: all 0.2s ease;
        }
        .action-icon-btn:hover {
            background: #f1f5f9;
            transform: translateY(-1px);
        }
        .action-icon-btn-danger {
            border-color: #fecdd3;
            color: #be123c;
        }
        .action-icon-btn-danger:hover {
            background: #fff1f2;
        }
        .modal-backdrop {
            background: rgba(15, 23, 42, 0.45);
        }
        .app-modal {
            border: 1px solid #d7dfec;
            border-radius: 0.9rem;
            background: #ffffff;
            color: #0f172a;
            box-shadow: 0 24px 48px rgba(15, 23, 42, 0.22);
            width: min(720px, 92vw);
            max-height: 88vh;
            overflow: auto;
            padding: 1.1rem;
        }
        .app-modal h3 {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }
        .app-modal form {
            gap: 0.75rem;
        }
        .app-modal input,
        .app-modal select {
            background: #f8fafc;
            border: 1px solid #d5dfed;
            color: #0f172a;
        }
        .app-modal input::placeholder {
            color: #7b8797;
        }
        .app-modal button[type="submit"] {
            grid-column: 1 / -1;
            width: 100%;
            justify-content: center;
        }
        .icon-chip {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.55rem;
            border: 1px solid #dbe4f1;
            background: #f8fafc;
            color: #334155;
        }
        .quick-card-btn {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.75rem;
            border: 1px solid #d9e2ef;
            background: #ffffff;
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.08);
            color: #0f172a;
            text-align: left;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .quick-card-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.12);
            border-color: #c2d2e8;
        }
        .quick-card-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.9rem;
            height: 1.9rem;
            border-radius: 0.5rem;
            background: #eef4ff;
            color: #1d4ed8;
            border: 1px solid #d7e3ff;
            flex-shrink: 0;
        }
        .quick-card-title {
            font-size: 0.82rem;
            font-weight: 600;
            color: #1e293b;
            line-height: 1.2rem;
        }
        dialog.app-modal {
            display: none;
            position: fixed;
            inset: 0;
            margin: auto;
            z-index: 60;
        }
        dialog.app-modal[open] {
            display: block;
        }
        dialog.app-modal::backdrop {
            background: rgba(15, 23, 42, 0.58);
        }
    </style>
</head>
<body class="admin-shell min-h-screen text-slate-900">
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
    button.admin-side-icon {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    button.admin-side-icon:hover {
        border-color: #cfd8ea;
        color: #2f3e63;
        transform: translateY(-1px);
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
    .hero-card {
        border-radius: 16px;
        background: linear-gradient(135deg, #3c2de2 0%, #4229f3 60%, #2a46e6 100%);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 16px 26px rgba(58, 44, 198, 0.3);
    }
    .finance-card {
        border-radius: 14px;
        padding: 0.9rem 1rem;
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
        position: relative;
        overflow: hidden;
    }
    .finance-card::after {
        content: '';
        position: absolute;
        inset: auto -10% -45% auto;
        width: 170px;
        height: 170px;
        border-radius: 999px;
        opacity: 0.14;
        background: #ffffff;
    }
    .credit-visual {
        background: linear-gradient(140deg, #f0cb66 0%, #e9bd50 100%);
        color: #1f2937;
    }
    .debit-visual {
        background: linear-gradient(140deg, #7cc3ff 0%, #5999ff 100%);
        color: #ffffff;
    }
    .card-actions {
        margin-top: 0.75rem;
        display: flex;
        gap: 0.45rem;
    }
    .card-action-btn {
        border: 1px solid rgba(15, 23, 42, 0.18);
        background: rgba(255, 255, 255, 0.82);
        color: #0f172a;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        padding: 0.22rem 0.55rem;
        font-weight: 600;
    }
    .card-action-btn-danger {
        border-color: rgba(190, 24, 93, 0.35);
        color: #9f1239;
    }
    .todo-item {
        border-left-width: 4px;
    }
    .todo-priority-overdue {
        border-left-color: #dc2626;
        background: #fff1f2;
    }
    .todo-priority-today {
        border-left-color: #ea580c;
        background: #fff7ed;
    }
    .todo-priority-upcoming {
        border-left-color: #2563eb;
        background: #eff6ff;
    }
    .todo-priority-none {
        border-left-color: #cbd5e1;
    }
    .todo-priority-chip {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        font-size: 0.67rem;
        font-weight: 600;
        padding: 0.12rem 0.5rem;
        border: 1px solid transparent;
    }
    .todo-chip-overdue {
        background: #fee2e2;
        color: #b91c1c;
        border-color: #fecaca;
    }
    .todo-chip-today {
        background: #ffedd5;
        color: #c2410c;
        border-color: #fed7aa;
    }
    .todo-chip-upcoming {
        background: #dbeafe;
        color: #1d4ed8;
        border-color: #bfdbfe;
    }
    .todo-chip-none {
        background: #f1f5f9;
        color: #475569;
        border-color: #e2e8f0;
    }
    .todo-action-btn {
        font-size: 0.72rem;
        font-weight: 600;
        border-radius: 0.45rem;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #334155;
        padding: 0.2rem 0.55rem;
    }
    .todo-action-btn-danger {
        border-color: #fecdd3;
        color: #be123c;
    }
    .history-table-wrap {
        border: 1px solid #e2e8f0;
        border-radius: 0.9rem;
        overflow: hidden;
    }
    .history-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.85rem;
    }
    .history-table thead th {
        background: #f8fafc;
        color: #475569;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 700;
        padding: 0.72rem 0.75rem;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
        white-space: nowrap;
    }
    .history-table tbody td {
        padding: 0.72rem 0.75rem;
        border-bottom: 1px solid #eef2f7;
        vertical-align: top;
        text-align: left;
    }
    .history-table thead th:not(:last-child),
    .history-table tbody td:not(:last-child) {
        border-right: 1px solid #e5eaf2;
    }
    .history-table tbody tr:hover {
        background: #f8fafc;
    }
    .history-table tbody tr:last-child td {
        border-bottom: 0;
    }
    .history-note-cell {
        min-width: 220px;
        max-width: 320px;
        color: #475569;
        white-space: normal;
        line-height: 1.35;
    }
    .history-action-cell {
        white-space: nowrap;
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
    @media (max-width: 768px) {
        .admin-shell {
            padding: 0.4rem;
        }
        .admin-frame {
            border-radius: 16px;
            min-height: calc(100vh - 1rem);
        }
        .admin-sidebar {
            justify-content: flex-start;
            overflow-x: auto;
            padding: 0.7rem 0.6rem;
            gap: 0.6rem;
        }
        .admin-side-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            flex: 0 0 auto;
        }
        .admin-main {
            padding: 0.9rem;
        }
        .admin-topbar {
            border-radius: 14px;
            padding: 0.85rem;
        }
        .admin-topbar h1 {
            font-size: 1.2rem;
            line-height: 1.55rem;
        }
        .history-note-cell {
            min-width: 170px;
            max-width: 240px;
        }
        .history-table thead th,
        .history-table tbody td {
            padding: 0.58rem 0.6rem;
            font-size: 0.78rem;
        }
        .todo-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.6rem;
        }
    }
    @media (max-width: 640px) {
        .admin-action-group {
            width: 100%;
            flex-direction: column;
            align-items: stretch;
        }
        .admin-action-group > * {
            width: 100%;
        }
        .expense-toolbar,
        .expense-filter-form {
            width: 100%;
        }
        .expense-toolbar .soft-input,
        .expense-toolbar .primary-btn,
        .expense-filter-form .soft-input,
        .expense-filter-form .primary-btn {
            width: 100%;
        }
        .hero-card .w-40 {
            width: 8rem;
            height: 8rem;
        }
        .history-table-wrap {
            border-radius: 0.7rem;
        }
    }
    .weight-progress-chart-wrap {
        height: 240px;
    }
    .weight-total-card {
        min-height: 240px;
    }
    .weight-calorie-chart-wrap {
        height: 240px;
    }
    .expense-pie-wrap {
        width: min(100%, 29rem);
        height: min(100%, 29rem);
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.1);
        padding: 0.25rem;
        box-shadow: 0 24px 30px rgba(15, 23, 42, 0.28);
    }
    .expense-pie-wrap canvas {
        width: 100% !important;
        height: 100% !important;
    }
    @media (max-width: 640px) {
        .expense-pie-wrap {
            width: min(100%, 20rem);
            height: min(100%, 20rem);
            padding: 0.2rem;
        }
        .weight-progress-chart-wrap {
            height: 210px;
        }
        .weight-total-card {
            min-height: 150px;
        }
        .weight-calorie-chart-wrap {
            height: 210px;
        }
    }
</style>
<div class="admin-frame">
    <aside class="admin-sidebar">
        <button type="button" class="admin-side-icon open-modal" data-modal="expenseCreateModal" title="Add Expense">
            <i class="fa-solid fa-wallet"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="incomeCreateModal" title="Add Income">
            <i class="fa-solid fa-money-bill-trend-up"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="creditCardCreateModal" title="Add Credit Card">
            <i class="fa-solid fa-credit-card"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="debitCardCreateModal" title="Add Debit Card">
            <i class="fa-solid fa-building-columns"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="cashBalanceEditModal" title="Edit cash in hand">
            <i class="fa-solid fa-money-bill-wave"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="stockCreateModal" title="Add Stock">
            <i class="fa-solid fa-chart-column"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="savingsAdjustmentCreateModal" title="Add Savings Adjustment">
            <i class="fa-solid fa-scale-balanced"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="categoryCreateModal" title="Add Category">
            <i class="fa-solid fa-tags"></i>
        </button>
        <button type="button" class="admin-side-icon open-modal" data-modal="weightLogCreateModal" title="Add Weight Entry">
            <i class="fa-solid fa-weight-scale"></i>
        </button>
    </aside>
<div class="admin-main">
    <div class="admin-topbar mb-6">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-semibold">Admin Expense Dashboard</h1>
            <p class="text-sm text-slate-600 mt-1">One page view for your todo list, wallet, and expense pie chart.</p>
        </div>
        <div class="admin-action-group flex items-center gap-2">
            <a href="{{ route('admin.visitors.index') }}" class="primary-btn bg-white px-4 py-2 text-sm font-medium !text-slate-100">
                <i class="fa-solid fa-chart-line text-xs"></i>
                Visitor Logs
            </a>
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button type="submit" class="primary-btn px-4 py-2 text-sm font-medium">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-lg bg-emerald-50 px-3 py-2 text-sm text-emerald-800">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="mt-4 rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-800">{{ $errors->first() }}</div>
    @endif

    <div class="grid xl:grid-cols-4 gap-6 mt-6">
        <section class="lg:col-span-1 rounded-xl bg-white p-5 panel">
            <h2 class="text-lg font-semibold">Todo List</h2>
            <p class="text-sm text-slate-500 mt-1">Local checklist for your daily tasks.</p>
            <form id="todoForm" class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-[1fr_auto_auto]">
                <input id="todoInput" type="text" placeholder="Add a task..." class="soft-input rounded-lg px-3 py-2 text-sm" required>
                <input id="todoDueDate" type="date" class="soft-input rounded-lg px-3 py-2 text-sm">
                <button type="submit" class="primary-btn px-4 py-2 text-sm font-medium">
                    <i class="fa-solid fa-plus text-[11px]"></i>
                    Add
                </button>
            </form>
            <ul id="todoList" class="mt-4 space-y-2"></ul>
        </section>

        <section class="xl:col-span-3 rounded-xl bg-white p-5 panel">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold">Expenses</h2>
                    <p class="text-sm text-slate-500">Filter by week, month, or year and track category spending.</p>
                </div>
                <div class="expense-toolbar flex flex-wrap items-center gap-2">
                    <form method="get" action="{{ route('admin.dashboard') }}" class="expense-filter-form flex flex-wrap items-center gap-2">
                        <select name="period" class="soft-input rounded-lg px-3 py-2 text-sm">
                            <option value="week" @selected($period === 'week')>Week</option>
                            <option value="month" @selected($period === 'month')>Month</option>
                            <option value="year" @selected($period === 'year')>Year</option>
                        </select>
                        <input type="number" name="year" min="2000" max="2100" value="{{ $selectedYear }}" class="soft-input rounded-lg px-3 py-2 text-sm w-28">
                        <button class="primary-btn px-4 py-2 text-sm">Apply</button>
                    </form>
                    <a href="{{ route('admin.expenses.export.csv', ['period' => $period, 'year' => $selectedYear]) }}" class="primary-btn px-3 py-2 text-xs">
                        <i class="fa-solid fa-file-csv text-xs"></i> CSV
                    </a>
                    <a href="{{ route('admin.expenses.export.excel', ['period' => $period, 'year' => $selectedYear]) }}" class="primary-btn px-3 py-2 text-xs">
                        <i class="fa-solid fa-file-excel text-xs"></i> Excel
                    </a>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-5">
                <div class="rounded-lg bg-slate-50 border border-slate-200 p-4">
                    <p class="text-xs uppercase text-slate-500">Selected Range</p>
                    <p class="font-medium mt-1">{{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Expense (direct)</p>
                    <p class="text-2xl font-semibold mt-1">Rs {{ number_format($totalExpense, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">EMI excluded from expense</p>
                    <p class="text-base font-semibold mt-1 text-amber-700">Rs {{ number_format($totalEmiExpense, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Credit used (counts as expense)</p>
                    <p class="text-base font-semibold mt-1 text-rose-700">Rs {{ number_format($totalCreditUsed, 2) }} / {{ number_format($totalCreditLimit, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Effective Expense</p>
                    <p class="text-lg font-semibold mt-1 text-rose-700">Rs {{ number_format($effectiveExpense, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Total Income</p>
                    <p class="text-xl font-semibold mt-1 text-emerald-700">Rs {{ number_format($totalIncome, 2) }}</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Bank savings balance</p>
                    <p class="text-base font-semibold mt-1 text-indigo-700">Rs {{ number_format($totalDebitBalance, 2) }}</p>
                    <div class="mt-3 flex flex-wrap items-center justify-between gap-2">
                        <p class="text-xs uppercase text-slate-500">Cash in hand balance</p>
                        <button type="button" class="card-action-btn open-modal" data-modal="cashBalanceEditModal">Edit</button>
                    </div>
                    <p class="text-base font-semibold mt-1 text-indigo-700">Rs {{ number_format($totalCashInHand, 2) }}</p>
                    <p class="text-[11px] text-slate-500 mt-1">Updates when you add income or expense as cash; use Edit to set or reconcile the balance.</p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Savings adjustment</p>
                    <p class="text-base font-semibold mt-1 {{ $totalSavingsAdjustment >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">
                        Rs {{ number_format($totalSavingsAdjustment, 2) }}
                    </p>
                    <p class="text-xs uppercase text-slate-500 mt-3">Savings (bank + cash - credit used + adjustments)</p>
                    <p class="text-lg font-semibold mt-1 {{ $savings >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">
                        Rs {{ number_format($savings, 2) }}
                    </p>
                </div>
                <div class="hero-card p-4">
                    <div class="expense-pie-wrap mx-auto">
                        <canvas id="pieChart" class="w-full h-full"></canvas>
                    </div>
                    <div id="pieLegend" class="mt-4 w-full space-y-2 max-h-40 overflow-auto pr-1"></div>
                </div>
            </div>

        </section>
    </div>

    <section class="rounded-xl bg-white p-5 mt-6 panel">
        <h2 class="text-lg font-semibold">Stock Value</h2>
        <p class="text-sm text-slate-500 mt-1">Invested stock amount shown separately.</p>
        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 rounded-xl border border-indigo-200 bg-gradient-to-r from-indigo-100 to-sky-100 px-5 py-6 text-slate-900 shadow">
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-600">Current Total</p>
                <p class="text-3xl font-semibold mt-2 text-indigo-900">Rs {{ number_format($totalStockValue, 2) }}</p>
            </div>
            <button type="button" class="primary-btn px-3 py-2 text-xs open-modal" data-modal="stockCreateModal">
                <i class="fa-solid fa-plus text-[10px]"></i> Add Stock
            </button>
        </div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel">
        <h2 class="text-lg font-semibold">Stock History</h2>
        <p class="text-sm text-slate-500 mt-1">Manage stock holdings with full CRUD.</p>
        <div class="overflow-x-auto mt-4">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                <tr>
                    <th class="text-left px-3 py-2">Symbol</th>
                    <th class="text-left px-3 py-2">Name</th>
                    <th class="text-left px-3 py-2">Quantity</th>
                    <th class="text-left px-3 py-2">Current Value</th>
                    <th class="text-left px-3 py-2">Notes</th>
                    <th class="text-left px-3 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($stockHoldings as $stock)
                    <tr class="border-t border-slate-100">
                        <td class="px-3 py-2 whitespace-nowrap">{{ $stock->symbol ?: '-' }}</td>
                        <td class="px-3 py-2">{{ $stock->name }}</td>
                        <td class="px-3 py-2 whitespace-nowrap">{{ number_format((float) $stock->quantity, 4) }}</td>
                        <td class="px-3 py-2 whitespace-nowrap font-medium text-indigo-700">Rs {{ number_format((float) $stock->current_value, 2) }}</td>
                        <td class="px-3 py-2">{{ $stock->notes ?: '-' }}</td>
                        <td class="px-3 py-2">
                            <div class="flex items-center gap-2">
                                <button type="button" class="card-action-btn open-modal" data-modal="stockEditModal{{ $stock->id }}">Edit</button>
                                <form method="post" action="{{ route('admin.stocks.delete', $stock) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="card-action-btn card-action-btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center px-3 py-6 text-slate-500">No stock holdings added yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $stockHoldings->links() }}</div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel">
        <div class="flex items-center justify-between gap-3 mb-4">
            <h2 class="text-lg font-semibold">Cards Overview</h2>
            <button type="button" class="primary-btn px-3 py-2 text-xs open-modal" data-modal="debitCardCreateModal">
                <i class="fa-solid fa-plus text-[10px]"></i> Add Bank Card
            </button>
        </div>
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
            @forelse ($creditCards as $card)
                <article class="finance-card credit-visual">
                    <div class="relative z-10">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-[11px] uppercase tracking-wide/4 opacity-75">Credit Card</p>
                                <p class="text-sm font-semibold mt-1">{{ $card->name }}</p>
                            </div>
                            <i class="fa-brands fa-cc-visa text-2xl opacity-85"></i>
                        </div>
                        <p class="text-[11px] mt-5 opacity-80">Used / Limit</p>
                        <p class="text-base font-semibold">Rs {{ number_format((float) $card->used_amount, 2) }} / {{ number_format((float) $card->total_limit, 2) }}</p>
                        <p class="text-[11px] mt-2 opacity-80">
                            {{ (float) $card->total_limit > 0 ? number_format(((float) $card->used_amount / (float) $card->total_limit) * 100, 1) : '0.0' }}% used
                        </p>
                        <div class="card-actions">
                            <button type="button" class="card-action-btn open-modal" data-modal="creditCardEditModal{{ $card->id }}">Edit</button>
                            <form method="post" action="{{ route('admin.credit-cards.delete', $card) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="card-action-btn card-action-btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-lg border border-dashed border-slate-300 px-4 py-6 text-sm text-slate-500">
                    No credit cards yet.
                </div>
            @endforelse

            @forelse ($debitCards as $card)
                <article class="finance-card debit-visual">
                    <div class="relative z-10">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-[11px] uppercase tracking-wide/4 text-white/80">Bank Name</p>
                                <p class="text-sm font-semibold mt-1">{{ $card->bank_name ?: '-' }}</p>
                            </div>
                            <i class="fa-solid fa-building-columns text-xl text-white/90"></i>
                        </div>
                        <p class="text-[11px] mt-5 text-white/80">Debit Card</p>
                        <p class="text-sm font-medium">{{ $card->name }}</p>
                        <p class="text-[11px] mt-2 text-white/80">Savings Amount</p>
                        <p class="text-base font-semibold">Rs {{ number_format((float) $card->current_balance, 2) }}</p>
                        <div class="card-actions">
                            <button type="button" class="card-action-btn open-modal" data-modal="debitCardEditModal{{ $card->id }}">Edit</button>
                            <form method="post" action="{{ route('admin.debit-cards.delete', $card) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="card-action-btn card-action-btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-lg border border-dashed border-slate-300 px-4 py-6 text-sm text-slate-500">
                    No debit cards yet.
                </div>
            @endforelse
        </div>
        @if (method_exists($creditCards, 'links') || method_exists($debitCards, 'links'))
            <div class="mt-3 flex flex-wrap items-center gap-3">
                <div>{{ $creditCards->links() }}</div>
                <div>{{ $debitCards->links() }}</div>
            </div>
        @endif
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel">
        <h2 class="text-lg font-semibold">Expense History</h2>
        <p class="text-sm text-slate-500 mt-1">Neat tabular view with direct edit and delete actions.</p>
        <div class="history-table-wrap mt-4 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Date</th>
                    <th class="text-left">Title</th>
                    <th class="text-left">Category</th>
                    <th class="text-left">Paid From</th>
                    <th class="text-left">Type</th>
                    <th class="text-left">Amount</th>
                    <th class="text-left">Notes</th>
                    <th class="text-left">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($expenses as $expense)
                    <tr>
                        <td class="whitespace-nowrap">{{ $expense->spent_on->format('d-m-Y') }}</td>
                        <td class="font-medium text-slate-800">{{ $expense->title }}</td>
                        <td>{{ $expense->category?->name ?: '-' }}</td>
                        <td>
                            @if ($expense->payment_channel === 'credit_card')
                                Credit - {{ $expense->creditCard?->name ?: '-' }}
                            @elseif ($expense->payment_channel === 'debit_card')
                                {{ $expense->debitCard?->bank_name ?: '-' }}
                            @else
                                Cash in hand
                            @endif
                        </td>
                        <td>
                            @if ($expense->is_emi)
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-amber-100 text-amber-900">EMI</span>
                            @else
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-slate-100 text-slate-700">Regular</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap font-semibold text-rose-700">Rs {{ number_format((float) $expense->amount, 2) }}</td>
                        <td class="history-note-cell">{{ $expense->notes ?: '-' }}</td>
                        <td class="history-action-cell">
                            <div class="flex items-center gap-2">
                                <button type="button" class="card-action-btn open-modal" data-modal="expenseEditModal{{ $expense->id }}">Edit</button>
                                <form method="post" action="{{ route('admin.expenses.delete', $expense) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="card-action-btn card-action-btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center px-3 py-6 text-slate-500">No expenses found in this range.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $expenses->links() }}</div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel">
        <h2 class="text-lg font-semibold">Income History</h2>
        <p class="text-sm text-slate-500 mt-1">Clean rows and columns for quick review and updates.</p>
        <div class="history-table-wrap mt-4 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Date</th>
                    <th class="text-left">Title</th>
                    <th class="text-left">Source</th>
                    <th class="text-left">Received In</th>
                    <th class="text-left">Amount</th>
                    <th class="text-left">Notes</th>
                    <th class="text-left">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($incomes as $income)
                    <tr>
                        <td class="whitespace-nowrap">{{ $income->received_on->format('d-m-Y') }}</td>
                        <td class="font-medium text-slate-800">{{ $income->title }}</td>
                        <td>{{ $income->source ?: '-' }}</td>
                        <td>
                            @if ($income->payment_channel === 'credit_card')
                                Credit - {{ $income->creditCard?->name ?: '-' }}
                            @elseif ($income->payment_channel === 'debit_card')
                                {{ $income->debitCard?->bank_name ?: '-' }}
                            @else
                                Cash in hand
                            @endif
                        </td>
                        <td class="whitespace-nowrap font-semibold text-emerald-700">Rs {{ number_format((float) $income->amount, 2) }}</td>
                        <td class="history-note-cell">{{ $income->notes ?: '-' }}</td>
                        <td class="history-action-cell">
                            <div class="flex items-center gap-2">
                                <button type="button" class="card-action-btn open-modal" data-modal="incomeEditModal{{ $income->id }}">Edit</button>
                                <form method="post" action="{{ route('admin.incomes.delete', $income) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="card-action-btn card-action-btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center px-3 py-6 text-slate-500">No income records found in this range.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $incomes->links() }}</div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel">
        <h2 class="text-lg font-semibold">Net worth analysis ({{ $netWorthMonthlyTrend['year'] }})</h2>
        <p class="text-sm text-slate-500 mt-1">Built only from your income and expense records. Solid bars are closed months (actual). Lighter bars are forecast. The current month blends what you logged so far with a projected finish. The line uses actual history through the last closed month, then extends with those monthly figures. Change the year with the filter above and click Apply.</p>
        @php($fc = $netWorthMonthlyTrend['forecast'] ?? [])
        <div class="mt-4 grid gap-3 sm:grid-cols-2 rounded-xl border border-slate-200 bg-slate-50/80 p-4">
            <div>
                <p class="text-[11px] font-semibold uppercase text-slate-500">This month (forecast)</p>
                <p class="text-lg font-semibold text-indigo-800 mt-1">{{ $fc['this_month_label'] ?? '' }}</p>
                <p class="text-xl font-semibold mt-0.5 {{ ($fc['this_month_rs'] ?? 0) >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">Rs {{ number_format((float) ($fc['this_month_rs'] ?? 0), 2) }}</p>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase text-slate-500">Next month (forecast)</p>
                <p class="text-lg font-semibold text-indigo-800 mt-1">{{ $fc['next_month_label'] ?? '' }}</p>
                <p class="text-xl font-semibold mt-0.5 {{ ($fc['next_month_rs'] ?? 0) >= 0 ? 'text-emerald-700' : 'text-rose-700' }}">Rs {{ number_format((float) ($fc['next_month_rs'] ?? 0), 2) }}</p>
            </div>
            <p class="text-xs text-slate-600 sm:col-span-2">{{ $fc['confidence_note'] ?? '' }} Avg monthly net used in forecasts: Rs {{ number_format((float) ($fc['avg_monthly_net_rs'] ?? 0), 2) }}.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-3 mt-4">
            <div class="rounded-xl border border-indigo-100 bg-gradient-to-br from-indigo-50 via-sky-50 to-cyan-50 p-3 shadow-sm">
                <p class="text-xs uppercase tracking-wide text-slate-600 mb-2">Monthly net (income − expense, incl. forecast)</p>
                <canvas id="netWorthBarChart" height="140"></canvas>
            </div>
            <div class="rounded-xl border border-teal-100 bg-gradient-to-br from-emerald-50 via-cyan-50 to-blue-50 p-3 shadow-sm">
                <p class="text-xs uppercase tracking-wide text-slate-600 mb-2">Cumulative flow (actual + projected)</p>
                <canvas id="netWorthLineChart" height="140"></canvas>
            </div>
        </div>
        <div class="history-table-wrap mt-4 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Month</th>
                    <th class="text-left">Monthly net</th>
                    <th class="text-left">Type</th>
                    <th class="text-left">Cumulative</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($netWorthMonthlyTrend['labels'] as $idx => $monthLabel)
                    @php($monthly = $netWorthMonthlyTrend['monthly_net'][$idx] ?? 0)
                    @php($cumulative = $netWorthMonthlyTrend['cumulative_flow'][$idx] ?? 0)
                    @php($kind = $netWorthMonthlyTrend['monthly_kinds'][$idx] ?? 'actual')
                    @php($kindLabel = $kind === 'blend' ? 'Blend' : ($kind === 'forecast' ? 'Forecast' : 'Actual'))
                    <tr>
                        <td class="font-medium text-slate-800">{{ $monthLabel }}</td>
                        <td class="whitespace-nowrap font-semibold {{ (float) $monthly >= 0 ? 'text-cyan-700' : 'text-rose-700' }}">
                            Rs {{ number_format((float) $monthly, 2) }}
                        </td>
                        <td class="text-xs text-slate-600">{{ $kindLabel }}</td>
                        <td class="whitespace-nowrap font-semibold {{ (float) $cumulative >= 0 ? 'text-cyan-700' : 'text-rose-700' }}">
                            Rs {{ number_format((float) $cumulative, 2) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <h3 class="text-sm font-semibold text-slate-800 mt-6">By calendar year (all-time)</h3>
        <p class="text-xs text-slate-500 mt-1">Totals from every income and expense row grouped by year.</p>
        <div class="history-table-wrap mt-3 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Year</th>
                    <th class="text-left">Income</th>
                    <th class="text-left">Expense</th>
                    <th class="text-left">Net</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($netWorthEntries as $row)
                    <tr>
                        <td class="font-medium text-slate-800">{{ $row['year'] }}</td>
                        <td class="whitespace-nowrap text-emerald-700 font-semibold">Rs {{ number_format((float) $row['income'], 2) }}</td>
                        <td class="whitespace-nowrap text-rose-700 font-semibold">Rs {{ number_format((float) $row['expense'], 2) }}</td>
                        <td class="whitespace-nowrap font-semibold {{ (float) $row['net'] >= 0 ? 'text-cyan-700' : 'text-rose-700' }}">
                            Rs {{ number_format((float) $row['net'], 2) }}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center px-3 py-6 text-slate-500">No income or expense data yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="rounded-xl bg-white p-5 mt-6 panel">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold">Weight Management</h2>
                <p class="text-sm text-slate-500 mt-1">Track daily weight, walking, calories, macros, and intake details.</p>
            </div>
            <button type="button" class="primary-btn px-3 py-2 text-xs open-modal" data-modal="weightLogCreateModal">
                <i class="fa-solid fa-plus text-[10px]"></i> Add Daily Entry
            </button>
        </div>
        <div class="grid md:grid-cols-2 gap-4 mt-4">
            <div class="rounded-xl border border-cyan-100 bg-gradient-to-br from-cyan-50 via-sky-50 to-blue-50 p-3 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                    <p class="text-xs uppercase tracking-wide text-slate-600">Weight Progress</p>
                    <span class="inline-flex items-center rounded-full bg-white/80 border border-cyan-200 px-2 py-0.5 text-[11px] font-semibold text-cyan-700">
                        Goal: 75 kg
                    </span>
                </div>
                <p id="weightGoalStatus" class="text-xs text-slate-600 mb-2"></p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mb-2">
                    <div class="rounded-lg bg-white/80 border border-slate-200 px-2 py-1.5">
                        <p class="text-[10px] uppercase text-slate-500">Prev Best</p>
                        <p class="text-sm font-semibold text-slate-800">80.50 kg</p>
                    </div>
                    <div class="rounded-lg bg-white/80 border border-slate-200 px-2 py-1.5">
                        <p class="text-[10px] uppercase text-slate-500">Prev Avg</p>
                        <p class="text-sm font-semibold text-slate-800">85.00 kg</p>
                    </div>
                    <div class="rounded-lg bg-white/80 border border-slate-200 px-2 py-1.5">
                        <p class="text-[10px] uppercase text-slate-500">Now</p>
                        <p class="text-sm font-semibold text-rose-700">89.90 kg</p>
                    </div>
                </div>
                <p id="weightDeltaStatus" class="text-xs text-slate-600 mb-2"></p>
                <div class="weight-progress-chart-wrap">
                    <canvas id="weightProgressChart"></canvas>
                </div>
            </div>
            <div class="weight-total-card rounded-xl border border-amber-100 bg-gradient-to-br from-amber-50 via-orange-50 to-rose-50 p-4 shadow-sm">
                <p class="text-xs uppercase tracking-wide text-slate-600 mb-2">Daily Calories (Hologram)</p>
                <div class="weight-calorie-chart-wrap">
                    <canvas id="dailyCaloriesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="history-table-wrap mt-4 overflow-x-auto">
            <table class="history-table">
                <thead>
                <tr>
                    <th class="text-left">Date</th>
                    <th class="text-left">Weight (kg)</th>
                    <th class="text-left">Walked</th>
                    <th class="text-left">Walk (km)</th>
                    <th class="text-left">Calories</th>
                    <th class="text-left">Macros (C/P/F)</th>
                    <th class="text-left">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($weightLogs as $log)
                    <tr>
                        <td class="whitespace-nowrap font-medium text-slate-800">{{ optional($log->logged_on)->format('d-m-Y') }}</td>
                        <td class="whitespace-nowrap">{{ number_format((float) $log->weight_kg, 2) }}</td>
                        <td>
                            @if ($log->did_walk)
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-emerald-100 text-emerald-800">Yes</span>
                            @else
                                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold bg-slate-100 text-slate-700">No</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap">{{ $log->walk_km !== null ? number_format((float) $log->walk_km, 2) : '-' }}</td>
                        <td class="whitespace-nowrap">{{ $log->calories_intake ?? '-' }}</td>
                        <td class="whitespace-nowrap">
                            {{ $log->carbs_g !== null ? number_format((float) $log->carbs_g, 0) : '-' }}/{{ $log->protein_g !== null ? number_format((float) $log->protein_g, 0) : '-' }}/{{ $log->fat_g !== null ? number_format((float) $log->fat_g, 0) : '-' }}
                        </td>
                        <td class="history-action-cell">
                            <div class="flex items-center gap-2">
                                <button type="button" class="card-action-btn open-modal" data-modal="weightLogEditModal{{ $log->id }}">Edit</button>
                                <form method="post" action="{{ route('admin.weight-logs.delete', $log) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="card-action-btn card-action-btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center px-3 py-6 text-slate-500">No weight entries yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $weightLogs->links() }}</div>
    </section>
</div>
</div>

<dialog id="categoryCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-tags text-xs"></i></span>Add Category</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.categories.store') }}" class="grid gap-3">
        @csrf
        <input name="name" required placeholder="New category" class="soft-input rounded-lg px-3 py-2 text-sm">
        <button class="primary-btn success-btn px-4 py-2 text-sm">Create</button>
    </form>
</dialog>

<dialog id="expenseCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-wallet text-xs"></i></span>Add Expense</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.expenses.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="title" placeholder="Expense title" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <select name="expense_category_id" required class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="payment_channel" class="soft-input rounded-lg px-3 py-2 text-sm" required>
            <option value="cash">Cash in hand</option>
            <option value="debit_card">Debit card / bank</option>
            <option value="credit_card">Credit card</option>
        </select>
        <select name="debit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select bank name (if using bank)</option>
            @foreach ($debitCardOptions as $card)
                <option value="{{ $card->id }}">{{ $card->bank_name ?: '-' }}</option>
            @endforeach
        </select>
        <select name="credit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select credit card (if using credit)</option>
            @foreach ($creditCardOptions as $card)
                <option value="{{ $card->id }}">{{ $card->name }}</option>
            @endforeach
        </select>
        <input type="number" name="amount" step="0.01" min="0.01" required placeholder="Amount" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="spent_on" required value="{{ now()->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <label class="md:col-span-2 inline-flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" name="is_emi" value="1">
            Mark as EMI (excluded from expense totals and pie chart)
        </label>
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Expense</button>
    </form>
</dialog>

<dialog id="incomeCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-money-bill-trend-up text-xs"></i></span>Add Income</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.incomes.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="title" placeholder="Income title" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="source" placeholder="Source (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <select name="payment_channel" class="soft-input rounded-lg px-3 py-2 text-sm" required>
            <option value="cash">Cash in hand</option>
            <option value="debit_card">Debit card / bank</option>
            <option value="credit_card">Credit card repayment</option>
        </select>
        <select name="debit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select bank name (if income goes to bank)</option>
            @foreach ($debitCardOptions as $card)
                <option value="{{ $card->id }}">{{ $card->bank_name ?: '-' }}</option>
            @endforeach
        </select>
        <select name="credit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select credit card (if paying card due)</option>
            @foreach ($creditCardOptions as $card)
                <option value="{{ $card->id }}">{{ $card->name }}</option>
            @endforeach
        </select>
        <input type="number" name="amount" step="0.01" min="0.01" required placeholder="Amount" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="received_on" required value="{{ now()->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Income</button>
    </form>
</dialog>

@foreach ($expenses as $expense)
<dialog id="expenseEditModal{{ $expense->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-wallet text-xs"></i></span>Edit Expense</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.expenses.update', $expense) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="title" value="{{ $expense->title }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <select name="expense_category_id" required class="soft-input rounded-lg px-3 py-2 text-sm">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected($expense->expense_category_id === $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="payment_channel" class="soft-input rounded-lg px-3 py-2 text-sm" required>
            <option value="cash" @selected(($expense->payment_channel ?? 'cash') === 'cash')>Cash in hand</option>
            <option value="debit_card" @selected($expense->payment_channel === 'debit_card')>Debit card / bank</option>
            <option value="credit_card" @selected($expense->payment_channel === 'credit_card')>Credit card</option>
        </select>
        <select name="debit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select bank name (if using bank)</option>
            @foreach ($debitCardOptions as $card)
                <option value="{{ $card->id }}" @selected((int) $expense->debit_card_id === (int) $card->id)>{{ $card->bank_name ?: '-' }}</option>
            @endforeach
        </select>
        <select name="credit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select credit card (if using credit)</option>
            @foreach ($creditCardOptions as $card)
                <option value="{{ $card->id }}" @selected((int) $expense->credit_card_id === (int) $card->id)>{{ $card->name }}</option>
            @endforeach
        </select>
        <input type="number" name="amount" step="0.01" min="0.01" value="{{ (float) $expense->amount }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="spent_on" value="{{ optional($expense->spent_on)->toDateString() }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <label class="md:col-span-2 inline-flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" name="is_emi" value="1" @checked($expense->is_emi)>
            Mark as EMI (excluded from expense totals and pie chart)
        </label>
        <input type="text" name="notes" value="{{ $expense->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Expense</button>
    </form>
</dialog>
@endforeach

@foreach ($incomes as $income)
<dialog id="incomeEditModal{{ $income->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-money-bill-trend-up text-xs"></i></span>Edit Income</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.incomes.update', $income) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="title" value="{{ $income->title }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="source" value="{{ $income->source }}" placeholder="Source (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <select name="payment_channel" class="soft-input rounded-lg px-3 py-2 text-sm" required>
            <option value="cash" @selected(($income->payment_channel ?? 'cash') === 'cash')>Cash in hand</option>
            <option value="debit_card" @selected($income->payment_channel === 'debit_card')>Debit card / bank</option>
            <option value="credit_card" @selected($income->payment_channel === 'credit_card')>Credit card repayment</option>
        </select>
        <select name="debit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select bank name (if income goes to bank)</option>
            @foreach ($debitCardOptions as $card)
                <option value="{{ $card->id }}" @selected((int) $income->debit_card_id === (int) $card->id)>{{ $card->bank_name ?: '-' }}</option>
            @endforeach
        </select>
        <select name="credit_card_id" class="soft-input rounded-lg px-3 py-2 text-sm">
            <option value="">Select credit card (if paying card due)</option>
            @foreach ($creditCardOptions as $card)
                <option value="{{ $card->id }}" @selected((int) $income->credit_card_id === (int) $card->id)>{{ $card->name }}</option>
            @endforeach
        </select>
        <input type="number" name="amount" step="0.01" min="0.01" value="{{ (float) $income->amount }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="received_on" value="{{ optional($income->received_on)->toDateString() }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" value="{{ $income->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Income</button>
    </form>
</dialog>
@endforeach

<dialog id="creditCardCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-credit-card text-xs"></i></span>Add Credit Card</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.credit-cards.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="name" placeholder="Card name" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="total_limit" step="0.01" min="0" required placeholder="Total limit" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="used_amount" step="0.01" min="0" required placeholder="Used amount" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Credit Card</button>
    </form>
</dialog>

<dialog id="debitCardCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-building-columns text-xs"></i></span>Add Debit Card</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.debit-cards.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="name" placeholder="Card name" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="bank_name" placeholder="Bank name (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="current_balance" step="0.01" required placeholder="Savings amount in bank (can be negative)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Debit Card</button>
    </form>
</dialog>

@foreach ($creditCards as $card)
<dialog id="creditCardEditModal{{ $card->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-credit-card text-xs"></i></span>Edit Credit Card</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.credit-cards.update', $card) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="name" value="{{ $card->name }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="total_limit" step="0.01" min="0" value="{{ (float) $card->total_limit }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="used_amount" step="0.01" min="0" value="{{ (float) $card->used_amount }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" value="{{ $card->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Credit Card</button>
    </form>
</dialog>
@endforeach

@foreach ($debitCards as $card)
<dialog id="debitCardEditModal{{ $card->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-building-columns text-xs"></i></span>Edit Debit Card</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.debit-cards.update', $card) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="name" value="{{ $card->name }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="bank_name" value="{{ $card->bank_name }}" placeholder="Bank name (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="current_balance" step="0.01" value="{{ (float) $card->current_balance }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" value="{{ $card->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Debit Card</button>
    </form>
</dialog>
@endforeach

@foreach ($stockHoldings as $stock)
<dialog id="stockEditModal{{ $stock->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-chart-column text-xs"></i></span>Edit Stock Holding</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.stocks.update', $stock) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="text" name="symbol" value="{{ $stock->symbol }}" placeholder="Symbol (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="name" value="{{ $stock->name }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="quantity" step="0.0001" min="0" value="{{ (float) $stock->quantity }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="current_value" step="0.01" min="0" value="{{ (float) $stock->current_value }}" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" value="{{ $stock->notes }}" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Stock</button>
    </form>
</dialog>
@endforeach

<dialog id="stockCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-chart-column text-xs"></i></span>Add Stock Holding</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.stocks.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="text" name="symbol" placeholder="Symbol (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="name" placeholder="Stock name" required class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="quantity" step="0.0001" min="0" required placeholder="Quantity" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="current_value" step="0.01" min="0" required placeholder="Current total value" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Notes (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Stock</button>
    </form>
</dialog>

<dialog id="savingsAdjustmentCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-scale-balanced text-xs"></i></span>Add Savings Adjustment</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.savings-adjustments.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="number" name="amount" step="0.01" required placeholder="Adjustment amount (+/-)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="date" name="adjusted_on" required value="{{ now()->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="text" name="notes" placeholder="Reason / note (optional)" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Adjustment</button>
    </form>
</dialog>

<dialog id="cashBalanceEditModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-money-bill-wave text-xs"></i></span>Cash in hand</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <p class="text-sm text-slate-600 mb-3">Set the current cash balance (same idea as editing a bank card balance). Cash income and cash expenses will move this amount automatically.</p>
    <form method="post" action="{{ route('admin.cash-balance.update') }}" class="grid gap-3">
        @csrf
        @method('put')
        <input type="number" name="current_balance" step="0.01" required value="{{ $cashBalance !== null ? number_format((float) $cashBalance->current_balance, 2, '.', '') : '0' }}" placeholder="Cash balance (Rs)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm">Save balance</button>
    </form>
</dialog>

<dialog id="weightLogCreateModal" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-weight-scale text-xs"></i></span>Add Daily Weight Entry</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.weight-logs.store') }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        <input type="date" name="logged_on" required value="{{ now()->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="weight_kg" step="0.01" min="20" max="300" required placeholder="Weight (kg)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <label class="inline-flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" name="did_walk" value="1"> Did I walk?
        </label>
        <input type="number" name="walk_km" step="0.01" min="0" max="100" placeholder="Walked KM (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <p class="text-xs font-semibold uppercase text-slate-500 md:col-span-2 mt-1">Meal wise nutrition</p>
        <input type="number" name="breakfast_calories" min="0" max="5000" placeholder="Breakfast calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="breakfast_carbs_g" step="0.01" min="0" max="1000" placeholder="Breakfast carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="breakfast_protein_g" step="0.01" min="0" max="1000" placeholder="Breakfast protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="breakfast_fat_g" step="0.01" min="0" max="1000" placeholder="Breakfast fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="lunch_calories" min="0" max="5000" placeholder="Lunch calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="lunch_carbs_g" step="0.01" min="0" max="1000" placeholder="Lunch carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="lunch_protein_g" step="0.01" min="0" max="1000" placeholder="Lunch protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="lunch_fat_g" step="0.01" min="0" max="1000" placeholder="Lunch fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="dinner_calories" min="0" max="5000" placeholder="Dinner calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="dinner_carbs_g" step="0.01" min="0" max="1000" placeholder="Dinner carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="dinner_protein_g" step="0.01" min="0" max="1000" placeholder="Dinner protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="dinner_fat_g" step="0.01" min="0" max="1000" placeholder="Dinner fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="snacks_calories" min="0" max="5000" placeholder="Snacks calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="snacks_carbs_g" step="0.01" min="0" max="1000" placeholder="Snacks carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="snacks_protein_g" step="0.01" min="0" max="1000" placeholder="Snacks protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="snacks_fat_g" step="0.01" min="0" max="1000" placeholder="Snacks fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm">
        <p class="text-xs font-semibold uppercase text-slate-500 md:col-span-2 mt-1">Auto totals</p>
        <input type="number" name="calories_intake" min="0" max="15000" placeholder="Total calories" readonly class="meal-calorie-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="carbs_g" step="0.01" min="0" max="2000" placeholder="Total carbs (g)" readonly class="meal-carb-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="protein_g" step="0.01" min="0" max="2000" placeholder="Total protein (g)" readonly class="meal-protein-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="fat_g" step="0.01" min="0" max="2000" placeholder="Total fats (g)" readonly class="meal-fat-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="text" name="intake_notes" placeholder="What I intake / notes" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Save Entry</button>
    </form>
</dialog>

@foreach ($weightLogs as $log)
<dialog id="weightLogEditModal{{ $log->id }}" class="app-modal">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-base font-semibold"><span class="icon-chip mr-2"><i class="fa-solid fa-weight-scale text-xs"></i></span>Edit Daily Weight Entry</h3>
        <button type="button" class="action-icon-btn close-modal"><i class="fa-solid fa-xmark text-xs"></i></button>
    </div>
    <form method="post" action="{{ route('admin.weight-logs.update', $log) }}" class="grid md:grid-cols-2 gap-3">
        @csrf
        @method('put')
        <input type="date" name="logged_on" required value="{{ optional($log->logged_on)->toDateString() }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="weight_kg" step="0.01" min="20" max="300" required value="{{ (float) $log->weight_kg }}" class="soft-input rounded-lg px-3 py-2 text-sm">
        <label class="inline-flex items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" name="did_walk" value="1" @checked($log->did_walk)> Did I walk?
        </label>
        <input type="number" name="walk_km" step="0.01" min="0" max="100" value="{{ $log->walk_km !== null ? (float) $log->walk_km : '' }}" placeholder="Walked KM (optional)" class="soft-input rounded-lg px-3 py-2 text-sm">
        <p class="text-xs font-semibold uppercase text-slate-500 md:col-span-2 mt-1">Meal wise nutrition</p>
        <input type="number" name="breakfast_calories" min="0" max="5000" placeholder="Breakfast calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="breakfast_carbs_g" step="0.01" min="0" max="1000" placeholder="Breakfast carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="breakfast_protein_g" step="0.01" min="0" max="1000" placeholder="Breakfast protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="breakfast_fat_g" step="0.01" min="0" max="1000" placeholder="Breakfast fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="lunch_calories" min="0" max="5000" placeholder="Lunch calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="lunch_carbs_g" step="0.01" min="0" max="1000" placeholder="Lunch carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="lunch_protein_g" step="0.01" min="0" max="1000" placeholder="Lunch protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="lunch_fat_g" step="0.01" min="0" max="1000" placeholder="Lunch fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="dinner_calories" min="0" max="5000" placeholder="Dinner calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="dinner_carbs_g" step="0.01" min="0" max="1000" placeholder="Dinner carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="dinner_protein_g" step="0.01" min="0" max="1000" placeholder="Dinner protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="dinner_fat_g" step="0.01" min="0" max="1000" placeholder="Dinner fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="snacks_calories" min="0" max="5000" placeholder="Snacks calories" class="meal-calorie-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="snacks_carbs_g" step="0.01" min="0" max="1000" placeholder="Snacks carbs (g)" class="meal-carb-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="snacks_protein_g" step="0.01" min="0" max="1000" placeholder="Snacks protein (g)" class="meal-protein-input soft-input rounded-lg px-3 py-2 text-sm">
        <input type="number" name="snacks_fat_g" step="0.01" min="0" max="1000" placeholder="Snacks fats (g)" class="meal-fat-input soft-input rounded-lg px-3 py-2 text-sm">
        <p class="text-xs font-semibold uppercase text-slate-500 md:col-span-2 mt-1">Auto totals</p>
        <input type="number" name="calories_intake" min="0" max="15000" value="{{ $log->calories_intake }}" placeholder="Total calories" readonly class="meal-calorie-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="carbs_g" step="0.01" min="0" max="2000" value="{{ $log->carbs_g !== null ? (float) $log->carbs_g : '' }}" placeholder="Total carbs (g)" readonly class="meal-carb-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="protein_g" step="0.01" min="0" max="2000" value="{{ $log->protein_g !== null ? (float) $log->protein_g : '' }}" placeholder="Total protein (g)" readonly class="meal-protein-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="number" name="fat_g" step="0.01" min="0" max="2000" value="{{ $log->fat_g !== null ? (float) $log->fat_g : '' }}" placeholder="Total fats (g)" readonly class="meal-fat-total soft-input rounded-lg px-3 py-2 text-sm bg-slate-100">
        <input type="text" name="intake_notes" value="{{ $log->intake_notes }}" placeholder="What I intake / notes" class="soft-input rounded-lg px-3 py-2 text-sm md:col-span-2">
        <button type="submit" class="primary-btn success-btn px-4 py-2 text-sm md:col-span-2">Update Entry</button>
    </form>
</dialog>
@endforeach

<script>
    const dashboardScrollKey = 'admin_dashboard_scroll_y';
    const categoryTotals = @json($categoryTotals);
    const expenseColors = ['#0ea5e9', '#14b8a6', '#f59e0b', '#f43f5e', '#6366f1', '#10b981', '#a855f7'];
    const todoKey = 'admin_todo_items';

    const todoList = document.getElementById('todoList');
    const todoForm = document.getElementById('todoForm');
    const todoInput = document.getElementById('todoInput');
    const todoDueDate = document.getElementById('todoDueDate');
    const pieChart = document.getElementById('pieChart');
    const pieLegend = document.getElementById('pieLegend');
    const openModalButtons = document.querySelectorAll('.open-modal');
    const closeModalButtons = document.querySelectorAll('.close-modal');
    const netWorthMonthlyTrend = @json($netWorthMonthlyTrend);
    const weightTrend = @json($weightTrend);
    const weightGoalKg = 75;
    const previousBestWeightKg = 80.5;
    const previousAvgWeightKg = 85;
    const currentReferenceWeightKg = 89.9;

    function restoreDashboardScrollPosition() {
        const storedY = sessionStorage.getItem(dashboardScrollKey);
        if (storedY === null) {
            return;
        }
        const y = Number(storedY);
        sessionStorage.removeItem(dashboardScrollKey);
        if (Number.isNaN(y)) {
            return;
        }
        window.requestAnimationFrame(() => {
            window.scrollTo({ top: y, behavior: 'auto' });
        });
    }

    function bindDashboardCrudScrollMemory() {
        document.querySelectorAll('form[method="post"]').forEach((form) => {
            form.addEventListener('submit', () => {
                const action = String(form.getAttribute('action') || '');
                if (action.includes('logout')) {
                    return;
                }
                sessionStorage.setItem(dashboardScrollKey, String(window.scrollY || 0));
            });
        });
    }

    restoreDashboardScrollPosition();
    bindDashboardCrudScrollMemory();

    let todos = JSON.parse(localStorage.getItem(todoKey) || '[]').map((todo) => ({
        title: todo.title ?? '',
        done: Boolean(todo.done),
        dueDate: typeof todo.dueDate === 'string' ? todo.dueDate : '',
    }));

    function saveTodos() {
        localStorage.setItem(todoKey, JSON.stringify(todos));
    }

    function getTodoPriority(dueDate) {
        if (!dueDate) {
            return { key: 'none', label: 'No date' };
        }

        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const due = new Date(`${dueDate}T00:00:00`);
        const diffDays = Math.floor((due.getTime() - today.getTime()) / 86400000);

        if (diffDays < 0) {
            return { key: 'overdue', label: 'Overdue' };
        }
        if (diffDays === 0) {
            return { key: 'today', label: 'Today' };
        }
        return { key: 'upcoming', label: 'Upcoming' };
    }

    function formatDueDate(dueDate) {
        if (!dueDate) {
            return 'No due date';
        }
        const date = new Date(`${dueDate}T00:00:00`);
        return date.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
    }

    function renderTodos() {
        todoList.innerHTML = '';
        todos.forEach((todo, index) => {
            const priority = getTodoPriority(todo.dueDate);
            const li = document.createElement('li');
            li.className = `todo-item flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2 todo-priority-${priority.key}`;
            li.innerHTML = `
                <div>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" ${todo.done ? 'checked' : ''} data-index="${index}" data-type="toggle">
                        <span class="${todo.done ? 'line-through text-slate-400' : 'text-slate-700'}">${todo.title}</span>
                    </label>
                    <div class="mt-1 ml-6 flex items-center gap-2">
                        <span class="text-xs text-slate-500">${formatDueDate(todo.dueDate)}</span>
                        <span class="todo-priority-chip todo-chip-${priority.key}">${priority.label}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="todo-action-btn" data-index="${index}" data-type="edit">Edit</button>
                    <button class="todo-action-btn todo-action-btn-danger" data-index="${index}" data-type="delete">Delete</button>
                </div>
            `;
            todoList.appendChild(li);
        });
    }

    let expensePieInstance = null;

    function renderPieChart() {
        const total = categoryTotals.reduce((sum, item) => sum + Number(item.total_amount), 0);
        if (!categoryTotals.length || total <= 0) {
            if (expensePieInstance) {
                expensePieInstance.destroy();
                expensePieInstance = null;
            }
            pieLegend.innerHTML = '<p class="text-sm text-slate-500 text-center">Add expense data to see chart.</p>';
            return;
        }

        if (expensePieInstance) {
            expensePieInstance.destroy();
        }

        const ctx = pieChart.getContext('2d');
        const depthColors = ['#075985', '#0f766e', '#b45309', '#be123c', '#4338ca', '#047857', '#7e22ce'];
        const shadowPlugin = {
            id: 'pieShadowDepth',
            beforeDraw(chart) {
                const dataset = chart.data.datasets?.[0];
                const meta = chart.getDatasetMeta(0);
                if (!dataset || !meta || !meta.data) {
                    return;
                }

                const context = chart.ctx;
                const slices = meta.data;
                const colors = dataset.backgroundColor || [];

                context.save();
                slices.forEach((arc, index) => {
                    const props = arc.getProps(['x', 'y', 'startAngle', 'endAngle', 'outerRadius', 'innerRadius'], true);
                    context.beginPath();
                    context.fillStyle = depthColors[index % depthColors.length] || colors[index % colors.length] || '#334155';
                    context.arc(props.x, props.y + 8, props.outerRadius, props.startAngle, props.endAngle);
                    context.arc(props.x, props.y + 8, props.innerRadius, props.endAngle, props.startAngle, true);
                    context.closePath();
                    context.globalAlpha = 0.55;
                    context.fill();
                });
                context.restore();
            },
            beforeDatasetDraw(chart) {
                const context = chart.ctx;
                context.save();
                context.shadowColor = 'rgba(15, 23, 42, 0.5)';
                context.shadowBlur = 22;
                context.shadowOffsetY = 10;
            },
            afterDatasetDraw(chart) {
                const context = chart.ctx;
                context.restore();

                // Soft top highlight makes slices appear more raised.
                const meta = chart.getDatasetMeta(0);
                if (!meta || !meta.data || meta.data.length === 0) {
                    return;
                }
                const firstArc = meta.data[0];
                const props = firstArc.getProps(['x', 'y', 'outerRadius'], true);
                const light = context.createRadialGradient(
                    props.x - props.outerRadius * 0.45,
                    props.y - props.outerRadius * 0.55,
                    8,
                    props.x,
                    props.y,
                    props.outerRadius
                );
                light.addColorStop(0, 'rgba(255, 255, 255, 0.38)');
                light.addColorStop(0.45, 'rgba(255, 255, 255, 0.12)');
                light.addColorStop(1, 'rgba(255, 255, 255, 0)');

                context.save();
                context.beginPath();
                context.arc(props.x, props.y, props.outerRadius, 0, Math.PI * 2);
                context.closePath();
                context.fillStyle = light;
                context.fill();
                context.restore();
            },
        };

        expensePieInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: categoryTotals.map((item) => item.name),
                datasets: [
                    {
                        data: categoryTotals.map((item) => Number(item.total_amount)),
                        backgroundColor: categoryTotals.map((item, index) => expenseColors[index % expenseColors.length]),
                        borderColor: '#ffffff',
                        borderWidth: 2,
                        hoverOffset: 8,
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                radius: '97%',
                cutout: '44%',
                layout: {
                    padding: 2,
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label(context) {
                                const value = Number(context.parsed || 0);
                                const percent = total > 0 ? ((value / total) * 100).toFixed(1) : '0.0';
                                return `${context.label}: Rs ${value.toLocaleString()} (${percent}%)`;
                            },
                        },
                    },
                },
            },
            plugins: [shadowPlugin],
        });

        pieLegend.innerHTML = categoryTotals.map((item, index) => {
            const amount = Number(item.total_amount);
            const percent = ((amount / total) * 100).toFixed(1);
            return `
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-3 h-3 rounded-full" style="background:${expenseColors[index % expenseColors.length]}"></span>
                        <span>${item.name}</span>
                    </div>
                    <span class="text-slate-100">Rs ${amount.toLocaleString()} (${percent}%)</span>
                </div>
            `;
        }).join('');
    }

    todoForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const title = todoInput.value.trim();
        if (!title) {
            return;
        }
        todos.unshift({ title, done: false, dueDate: todoDueDate.value || '' });
        todoInput.value = '';
        todoDueDate.value = '';
        saveTodos();
        renderTodos();
    });

    todoList.addEventListener('click', (event) => {
        const target = event.target;
        const index = Number(target.dataset.index);
        const type = target.dataset.type;
        if (type === 'edit') {
            const current = todos[index];
            if (!current) {
                return;
            }
            const nextTitle = window.prompt('Edit task title', current.title);
            if (nextTitle === null) {
                return;
            }
            const trimmedTitle = nextTitle.trim();
            if (!trimmedTitle) {
                window.alert('Task title cannot be empty.');
                return;
            }
            const nextDueDate = window.prompt('Edit due date (YYYY-MM-DD), leave empty for none', current.dueDate || '');
            if (nextDueDate === null) {
                return;
            }
            const trimmedDueDate = nextDueDate.trim();
            if (trimmedDueDate && !/^\d{4}-\d{2}-\d{2}$/.test(trimmedDueDate)) {
                window.alert('Due date format must be YYYY-MM-DD.');
                return;
            }
            todos[index] = {
                ...current,
                title: trimmedTitle,
                dueDate: trimmedDueDate,
            };
            saveTodos();
            renderTodos();
            return;
        }
        if (type === 'delete') {
            todos.splice(index, 1);
            saveTodos();
            renderTodos();
        }
    });

    todoList.addEventListener('change', (event) => {
        const target = event.target;
        const index = Number(target.dataset.index);
        if (target.dataset.type === 'toggle') {
            todos[index].done = target.checked;
            saveTodos();
            renderTodos();
        }
    });

    renderTodos();
    renderPieChart();
    renderNetWorthCharts();
    renderWeightProgressChart();
    renderDailyCaloriesChart();

    openModalButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const modalId = button.dataset.modal;
            const modal = document.getElementById(modalId);
            if (!modal) {
                return;
            }
            if (typeof modal.showModal === 'function') {
                modal.showModal();
            } else {
                modal.setAttribute('open', 'open');
            }
            modal.classList.add('modal-backdrop');
        });
    });

    closeModalButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const modal = button.closest('dialog');
            if (modal) {
                if (typeof modal.close === 'function') {
                    modal.close();
                } else {
                    modal.removeAttribute('open');
                }
            }
        });
    });

    document.querySelectorAll('dialog').forEach((modal) => {
        modal.addEventListener('click', (event) => {
            const dialogDimensions = modal.getBoundingClientRect();
            const isInDialog =
                event.clientX >= dialogDimensions.left &&
                event.clientX <= dialogDimensions.right &&
                event.clientY >= dialogDimensions.top &&
                event.clientY <= dialogDimensions.bottom;

            if (!isInDialog) {
                if (typeof modal.close === 'function') {
                    modal.close();
                } else {
                    modal.removeAttribute('open');
                }
            }
        });
    });

    function bindMealCalorieTotals() {
        document.querySelectorAll('dialog form').forEach((form) => {
            const calorieInputs = form.querySelectorAll('.meal-calorie-input');
            const carbInputs = form.querySelectorAll('.meal-carb-input');
            const proteinInputs = form.querySelectorAll('.meal-protein-input');
            const fatInputs = form.querySelectorAll('.meal-fat-input');
            const calorieTotalInput = form.querySelector('.meal-calorie-total');
            const carbTotalInput = form.querySelector('.meal-carb-total');
            const proteinTotalInput = form.querySelector('.meal-protein-total');
            const fatTotalInput = form.querySelector('.meal-fat-total');

            if (!calorieInputs.length || !calorieTotalInput) {
                return;
            }

            const sumInputs = (inputs) => {
                let total = 0;
                inputs.forEach((input) => {
                    const value = Number(input.value || 0);
                    if (!Number.isNaN(value) && value > 0) {
                        total += value;
                    }
                });
                return total;
            };

            const updateTotal = () => {
                const calories = sumInputs(calorieInputs);
                const carbs = sumInputs(carbInputs);
                const protein = sumInputs(proteinInputs);
                const fat = sumInputs(fatInputs);

                calorieTotalInput.value = calories > 0 ? String(Math.round(calories)) : '';
                if (carbTotalInput) {
                    carbTotalInput.value = carbs > 0 ? carbs.toFixed(2) : '';
                }
                if (proteinTotalInput) {
                    proteinTotalInput.value = protein > 0 ? protein.toFixed(2) : '';
                }
                if (fatTotalInput) {
                    fatTotalInput.value = fat > 0 ? fat.toFixed(2) : '';
                }
            };

            [
                ...calorieInputs,
                ...carbInputs,
                ...proteinInputs,
                ...fatInputs,
            ].forEach((input) => {
                input.addEventListener('input', updateTotal);
                input.addEventListener('change', updateTotal);
            });
        });
    }

    bindMealCalorieTotals();

    function renderNetWorthCharts() {
        const labels = Array.isArray(netWorthMonthlyTrend?.labels) ? netWorthMonthlyTrend.labels : [];
        const monthlyNet = Array.isArray(netWorthMonthlyTrend?.monthly_net)
            ? netWorthMonthlyTrend.monthly_net.map((value) => Number(value))
            : [];
        const monthlyKinds = Array.isArray(netWorthMonthlyTrend?.monthly_kinds)
            ? netWorthMonthlyTrend.monthly_kinds
            : [];
        const cumulativeFlow = Array.isArray(netWorthMonthlyTrend?.cumulative_flow)
            ? netWorthMonthlyTrend.cumulative_flow.map((value) => Number(value))
            : [];
        const barColors = monthlyNet.map((_, i) => {
            const k = monthlyKinds[i] || 'actual';
            if (k === 'forecast') {
                return 'rgba(148, 163, 184, 0.55)';
            }
            if (k === 'blend') {
                return 'rgba(56, 189, 248, 0.72)';
            }
            return 'rgba(14, 165, 233, 0.88)';
        });

        const lineEl = document.getElementById('netWorthLineChart');
        const barEl = document.getElementById('netWorthBarChart');
        if (!lineEl || !barEl || labels.length === 0) {
            return;
        }

        new Chart(lineEl, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Cumulative (Rs)',
                        data: cumulativeFlow,
                        borderColor: '#0891b2',
                        backgroundColor: 'rgba(8,145,178,0.2)',
                        fill: true,
                        tension: 0.35,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                const v = Number(ctx.parsed?.y ?? 0);
                                return `Rs ${v.toLocaleString()}`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(148,163,184,0.2)' },
                    },
                    y: {
                        grid: { color: 'rgba(148,163,184,0.2)' },
                        title: { display: true, text: 'Rs (cumulative)' },
                    },
                },
            },
        });

        new Chart(barEl, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Monthly net (Rs)',
                        data: monthlyNet,
                        backgroundColor: barColors,
                        borderColor: '#0284c7',
                        borderWidth: 1.2,
                    },
                ],
            },
            options: {
                responsive: true,
                datasets: {
                    bar: {
                        borderRadius: 5,
                    },
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                const v = Number(ctx.parsed?.y ?? 0);
                                return `Rs ${v.toLocaleString()}`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(148,163,184,0.2)' },
                        title: { display: true, text: 'Month' },
                    },
                    y: {
                        grid: { color: 'rgba(148,163,184,0.2)' },
                        title: { display: true, text: 'Rs (this month)' },
                    },
                },
            },
        });
    }

    function renderWeightProgressChart() {
        const chartEl = document.getElementById('weightProgressChart');
        const goalStatusEl = document.getElementById('weightGoalStatus');
        const deltaStatusEl = document.getElementById('weightDeltaStatus');
        const labels = Array.isArray(weightTrend?.labels) ? weightTrend.labels : [];
        const series = Array.isArray(weightTrend?.weights) ? weightTrend.weights.map((value) => Number(value)) : [];
        if (!chartEl || labels.length === 0 || series.length === 0) {
            if (goalStatusEl) {
                goalStatusEl.textContent = `Goal target: ${weightGoalKg.toFixed(0)} kg`;
            }
            if (deltaStatusEl) {
                deltaStatusEl.textContent = `Vs best: +${(currentReferenceWeightKg - previousBestWeightKg).toFixed(2)} kg | Vs avg: +${(currentReferenceWeightKg - previousAvgWeightKg).toFixed(2)} kg`;
            }
            return;
        }
        const latestWeight = Number(series[series.length - 1] || 0);
        const remaining = latestWeight - weightGoalKg;
        if (goalStatusEl) {
            if (remaining > 0) {
                goalStatusEl.textContent = `Current: ${latestWeight.toFixed(2)} kg ( ${remaining.toFixed(2)} kg above goal )`;
            } else if (remaining < 0) {
                goalStatusEl.textContent = `Current: ${latestWeight.toFixed(2)} kg ( ${Math.abs(remaining).toFixed(2)} kg below goal )`;
            } else {
                goalStatusEl.textContent = `Current: ${latestWeight.toFixed(2)} kg (goal reached)`;
            }
        }
        if (deltaStatusEl) {
            const bestDelta = latestWeight - previousBestWeightKg;
            const avgDelta = latestWeight - previousAvgWeightKg;
            deltaStatusEl.textContent = `Vs best (${previousBestWeightKg.toFixed(2)}): ${bestDelta >= 0 ? '+' : ''}${bestDelta.toFixed(2)} kg | Vs avg (${previousAvgWeightKg.toFixed(2)}): ${avgDelta >= 0 ? '+' : ''}${avgDelta.toFixed(2)} kg`;
        }
        const goalLine = labels.map(() => weightGoalKg);

        new Chart(chartEl, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Weight (kg)',
                        data: series,
                        borderColor: '#0ea5e9',
                        backgroundColor: 'rgba(14,165,233,0.18)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 2.5,
                        pointHoverRadius: 4,
                    },
                    {
                        label: 'Goal (75 kg)',
                        data: goalLine,
                        borderColor: '#f97316',
                        borderWidth: 1.5,
                        borderDash: [6, 4],
                        pointRadius: 0,
                        fill: false,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'bottom' },
                },
                scales: {
                    x: {
                        ticks: {
                            maxTicksLimit: 7,
                        },
                        grid: { color: 'rgba(148,163,184,0.2)' },
                    },
                    y: {
                        grid: { color: 'rgba(148,163,184,0.2)' },
                        title: { display: true, text: 'Weight (kg)' },
                    },
                },
            },
        });
    }

    function renderDailyCaloriesChart() {
        const chartEl = document.getElementById('dailyCaloriesChart');
        const labels = Array.isArray(weightTrend?.labels) ? weightTrend.labels : [];
        const calories = Array.isArray(weightTrend?.calories) ? weightTrend.calories.map((value) => Number(value || 0)) : [];
        if (!chartEl || labels.length === 0 || calories.length === 0) {
            return;
        }

        const ctx = chartEl.getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, 'rgba(251, 146, 60, 0.95)');
        gradient.addColorStop(1, 'rgba(251, 146, 60, 0.28)');

        new Chart(chartEl, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Calories',
                        data: calories,
                        backgroundColor: gradient,
                        borderColor: '#ea580c',
                        borderWidth: 1.2,
                        borderRadius: 6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: {
                        ticks: { maxTicksLimit: 7 },
                        grid: { color: 'rgba(148,163,184,0.2)' },
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(148,163,184,0.2)' },
                        title: { display: true, text: 'Calories' },
                    },
                },
            },
        });
    }
</script>
</body>
</html>
