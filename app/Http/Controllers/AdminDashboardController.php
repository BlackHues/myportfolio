<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Income;
use App\Models\CashBalance;
use App\Models\CreditCard;
use App\Models\DebitCard;
use App\Models\AdminTodo;
use App\Models\NetWorthEntry;
use App\Models\SavingsAdjustment;
use App\Models\StockHolding;
use App\Models\WeightLog;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $period = (string) $request->query('period', 'month');
        $selectedYear = (int) $request->query('year', now()->year);

        [$startDate, $endDate] = $this->resolveDateRange($period, $selectedYear);

        $expenseQuery = $this->filteredExpenseQuery($startDate, $endDate)->with(['category', 'debitCard', 'creditCard']);
        $nonEmiExpenseQuery = (clone $expenseQuery)->where('is_emi', false);

        $expenses = (clone $expenseQuery)
            ->latest('spent_on')
            ->latest('id')
            ->paginate(20)
            ->appends($request->query());

        $categoryTotals = (clone $nonEmiExpenseQuery)
            ->join('expense_categories', 'expense_categories.id', '=', 'expenses.expense_category_id')
            ->select('expense_categories.name', DB::raw('SUM(expenses.amount) as total_amount'))
            ->groupBy('expense_categories.id', 'expense_categories.name')
            ->orderByDesc('total_amount')
            ->get();

        $totalExpense = (clone $nonEmiExpenseQuery)->sum('amount');
        $totalEmiExpense = (clone $expenseQuery)->where('is_emi', true)->sum('amount');
        $totalEmiCreditExpense = (clone $expenseQuery)
            ->where('is_emi', true)
            ->where('payment_channel', 'credit_card')
            ->sum('amount');
        $incomeQuery = Income::query()
            ->with(['debitCard', 'creditCard'])
            ->whereBetween('received_on', [$startDate->toDateString(), $endDate->toDateString()]);
        $cashBalance = CashBalance::query()->first();
        $totalCashInHand = $cashBalance ? (float) $cashBalance->current_balance : 0.0;
        $totalIncome = (clone $incomeQuery)->sum('amount');
        $incomes = (clone $incomeQuery)
            ->latest('received_on')
            ->latest('id')
            ->paginate(20, ['*'], 'income_page')
            ->appends($request->query());
        $creditCards = CreditCard::query()
            ->latest('id')
            ->paginate(20, ['*'], 'credit_page')
            ->appends($request->query());
        $debitCards = DebitCard::query()
            ->latest('id')
            ->paginate(20, ['*'], 'debit_page')
            ->appends($request->query());
        $stockHoldings = StockHolding::query()
            ->latest('id')
            ->paginate(20, ['*'], 'stock_page')
            ->appends($request->query());
        $weightLogs = WeightLog::query()
            ->latest('logged_on')
            ->latest('id')
            ->paginate(31, ['*'], 'weight_page')
            ->appends($request->query());
        $weightChartLogs = WeightLog::query()
            ->orderBy('logged_on')
            ->orderBy('id')
            ->get(['logged_on', 'weight_kg', 'calories_intake']);
        $weightTrend = [
            'labels' => $weightChartLogs
                ->map(static fn (WeightLog $log): string => optional($log->logged_on)->format('d M Y') ?? '-')
                ->values(),
            'weights' => $weightChartLogs
                ->map(static fn (WeightLog $log): float => (float) $log->weight_kg)
                ->values(),
            'calories' => $weightChartLogs
                ->map(static fn (WeightLog $log): int => (int) ($log->calories_intake ?? 0))
                ->values(),
        ];
        $totalCaloriesIntake = (int) $weightChartLogs
            ->sum(static fn (WeightLog $log): int => (int) ($log->calories_intake ?? 0));
        $totalCreditUsed = CreditCard::query()->sum('used_amount');
        $totalCreditLimit = CreditCard::query()->sum('total_limit');
        $totalDebitBalance = DebitCard::query()->sum('current_balance');
        $totalStockValue = StockHolding::query()->sum('current_value');
        $totalSavingsAdjustment = SavingsAdjustment::query()->sum('amount');
        $savingsAdjustments = SavingsAdjustment::query()
            ->latest('adjusted_on')
            ->latest('id')
            ->get();
        $effectiveCreditUsed = (float) $totalCreditUsed - (float) $totalEmiCreditExpense;
        $effectiveExpense = (float) $totalExpense + $effectiveCreditUsed;
        $savings = (float) $totalDebitBalance + $totalCashInHand - $effectiveCreditUsed + (float) $totalSavingsAdjustment;

        $categories = ExpenseCategory::query()
            ->withCount('expenses')
            ->orderBy('name')
            ->get();
        $creditCardOptions = CreditCard::query()->orderBy('name')->get(['id', 'name']);
        $debitCardOptions = DebitCard::query()->orderBy('name')->get(['id', 'name', 'bank_name']);

        $incomeByYear = Income::query()
            ->selectRaw('YEAR(received_on) as year, SUM(amount) as total_income')
            ->groupByRaw('YEAR(received_on)')
            ->pluck('total_income', 'year');
        $expenseByYear = Expense::query()
            ->selectRaw('YEAR(spent_on) as year, SUM(amount) as total_expense')
            ->groupByRaw('YEAR(spent_on)')
            ->pluck('total_expense', 'year');
        $yearKeys = collect($incomeByYear->keys())
            ->merge($expenseByYear->keys())
            ->map(static fn ($year): int => (int) $year)
            ->unique()
            ->sortDesc()
            ->values();
        $netWorthEntries = $yearKeys->map(function (int $year) use ($incomeByYear, $expenseByYear): array {
            $income = (float) ($incomeByYear[$year] ?? 0);
            $expense = (float) ($expenseByYear[$year] ?? 0);
            return [
                'year' => $year,
                'income' => $income,
                'expense' => $expense,
                'net' => $income - $expense,
            ];
        });
        $netWorthMonthlyTrend = $this->buildNetWorthMonthlyAnalysis($selectedYear);
        $todoItems = AdminTodo::query()
            ->where('user_id', (int) $request->user()->id)
            ->orderBy('order_index')
            ->orderBy('id')
            ->get()
            ->map(static fn (AdminTodo $todo): array => [
                'id' => (int) $todo->id,
                'title' => (string) $todo->title,
                'status' => (string) $todo->status,
                'pinned' => (bool) $todo->is_pinned,
                'dueDate' => optional($todo->due_date)->format('Y-m-d') ?? '',
                'createdAt' => (int) $todo->created_at_ms,
                'order' => (int) $todo->order_index,
            ])
            ->values();

        return view('admin.dashboard', [
            'period' => $period,
            'selectedYear' => $selectedYear,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'expenses' => $expenses,
            'categoryTotals' => $categoryTotals,
            'totalExpense' => (float) $totalExpense,
            'totalIncome' => (float) $totalIncome,
            'totalEmiExpense' => (float) $totalEmiExpense,
            'totalCreditUsed' => (float) $totalCreditUsed,
            'totalCreditLimit' => (float) $totalCreditLimit,
            'totalDebitBalance' => (float) $totalDebitBalance,
            'totalCashInHand' => $totalCashInHand,
            'cashBalance' => $cashBalance,
            'totalStockValue' => (float) $totalStockValue,
            'totalSavingsAdjustment' => (float) $totalSavingsAdjustment,
            'effectiveExpense' => $effectiveExpense,
            'netBalance' => (float) $totalIncome - (float) $totalExpense,
            'savings' => $savings,
            'categories' => $categories,
            'creditCardOptions' => $creditCardOptions,
            'debitCardOptions' => $debitCardOptions,
            'incomes' => $incomes,
            'creditCards' => $creditCards,
            'debitCards' => $debitCards,
            'stockHoldings' => $stockHoldings,
            'weightLogs' => $weightLogs,
            'weightTrend' => $weightTrend,
            'totalCaloriesIntake' => $totalCaloriesIntake,
            'savingsAdjustments' => $savingsAdjustments,
            'netWorthEntries' => $netWorthEntries,
            'netWorthMonthlyTrend' => $netWorthMonthlyTrend,
            'todoItems' => $todoItems,
        ]);
    }

    public function syncTodos(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'todos' => ['array', 'max:500'],
            'todos.*.title' => ['required', 'string', 'max:1000'],
            'todos.*.status' => ['required', 'in:incomplete,completed,dropped'],
            'todos.*.pinned' => ['nullable', 'boolean'],
            'todos.*.dueDate' => ['nullable', 'date_format:Y-m-d'],
            'todos.*.createdAt' => ['nullable', 'integer', 'min:1'],
            'todos.*.order' => ['nullable', 'integer', 'min:0'],
        ]);

        $userId = (int) $request->user()->id;
        $inputTodos = collect($validated['todos'] ?? []);

        DB::transaction(function () use ($userId, $inputTodos): void {
            AdminTodo::query()->where('user_id', $userId)->delete();

            if ($inputTodos->isEmpty()) {
                return;
            }

            $now = now();
            $rows = $inputTodos->values()->map(static function (array $todo, int $index) use ($userId, $now): array {
                $title = trim((string) ($todo['title'] ?? ''));
                if ($title === '') {
                    $title = 'Untitled task';
                }
                return [
                    'user_id' => $userId,
                    'title' => mb_substr($title, 0, 150),
                    'status' => (string) $todo['status'],
                    'is_pinned' => (bool) ($todo['pinned'] ?? false),
                    'due_date' => isset($todo['dueDate']) && $todo['dueDate'] !== '' ? $todo['dueDate'] : null,
                    'created_at_ms' => (int) ($todo['createdAt'] ?? now()->valueOf()),
                    'order_index' => (int) ($todo['order'] ?? $index + 1),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })->all();

            AdminTodo::query()->insert($rows);
        });

        $freshTodos = AdminTodo::query()
            ->where('user_id', $userId)
            ->orderBy('order_index')
            ->orderBy('id')
            ->get()
            ->map(static fn (AdminTodo $todo): array => [
                'id' => (int) $todo->id,
                'title' => (string) $todo->title,
                'status' => (string) $todo->status,
                'pinned' => (bool) $todo->is_pinned,
                'dueDate' => optional($todo->due_date)->format('Y-m-d') ?? '',
                'createdAt' => (int) $todo->created_at_ms,
                'order' => (int) $todo->order_index,
            ])
            ->values();

        return response()->json([
            'ok' => true,
            'todos' => $freshTodos,
        ]);
    }

    public function exportExpensesCsv(Request $request): StreamedResponse
    {
        $period = (string) $request->query('period', 'month');
        $selectedYear = (int) $request->query('year', now()->year);
        [$startDate, $endDate] = $this->resolveDateRange($period, $selectedYear);

        $rows = $this->filteredExpenseQuery($startDate, $endDate)
            ->with('category')
            ->latest('spent_on')
            ->latest('id')
            ->get();

        $fileName = 'expenses-' . $period . '-' . $startDate->format('Ymd') . '-' . $endDate->format('Ymd') . '.csv';

        return response()->streamDownload(function () use ($rows): void {
            $handle = fopen('php://output', 'wb');
            fputcsv($handle, ['Date', 'Title', 'Category', 'Amount', 'Notes']);

            foreach ($rows as $expense) {
                fputcsv($handle, [
                    optional($expense->spent_on)->format('Y-m-d'),
                    $expense->title,
                    $expense->category?->name ?? '',
                    number_format((float) $expense->amount, 2, '.', ''),
                    $expense->notes ?? '',
                ]);
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function exportExpensesExcel(Request $request): StreamedResponse
    {
        $period = (string) $request->query('period', 'month');
        $selectedYear = (int) $request->query('year', now()->year);
        [$startDate, $endDate] = $this->resolveDateRange($period, $selectedYear);

        $rows = $this->filteredExpenseQuery($startDate, $endDate)
            ->with('category')
            ->latest('spent_on')
            ->latest('id')
            ->get();

        $fileName = 'expenses-' . $period . '-' . $startDate->format('Ymd') . '-' . $endDate->format('Ymd') . '.xls';

        return response()->streamDownload(function () use ($rows, $period, $startDate, $endDate): void {
            echo '<html><head><meta charset="UTF-8"></head><body>';
            echo '<table border="1">';
            echo '<tr><th colspan="5">Filtered Expenses (' . e($period) . ') - ' . e($startDate->format('d M Y')) . ' to ' . e($endDate->format('d M Y')) . '</th></tr>';
            echo '<tr><th>Date</th><th>Title</th><th>Category</th><th>Amount</th><th>Notes</th></tr>';

            foreach ($rows as $expense) {
                echo '<tr>';
                echo '<td>' . e(optional($expense->spent_on)->format('Y-m-d')) . '</td>';
                echo '<td>' . e($expense->title) . '</td>';
                echo '<td>' . e($expense->category?->name ?? '') . '</td>';
                echo '<td>' . e(number_format((float) $expense->amount, 2, '.', '')) . '</td>';
                echo '<td>' . e($expense->notes ?? '') . '</td>';
                echo '</tr>';
            }

            echo '</table></body></html>';
        }, $fileName, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:expense_categories,name'],
        ]);

        ExpenseCategory::query()->create($data);

        return back()->with('status', 'Category created.');
    }

    public function updateCategory(Request $request, ExpenseCategory $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:expense_categories,name,' . $category->id],
        ]);

        $category->update($data);

        return back()->with('status', 'Category updated.');
    }

    public function deleteCategory(ExpenseCategory $category): RedirectResponse
    {
        if ($category->expenses()->exists()) {
            return back()->withErrors(['category' => 'Cannot delete category with expenses.']);
        }

        $category->delete();

        return back()->with('status', 'Category deleted.');
    }

    public function storeExpense(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'expense_category_id' => ['required', 'integer', 'exists:expense_categories,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'spent_on' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'payment_channel' => ['required', 'in:cash,debit_card,credit_card'],
            'debit_card_id' => ['nullable', 'required_if:payment_channel,debit_card', 'integer', 'exists:debit_cards,id'],
            'credit_card_id' => ['nullable', 'required_if:payment_channel,credit_card', 'integer', 'exists:credit_cards,id'],
            'is_emi' => ['nullable', 'boolean'],
        ]);
        $data = $this->normalizeAccountLinkData($data);

        DB::transaction(function () use ($data): void {
            $expense = Expense::query()->create($data);
            $this->applyExpenseImpact($expense);
        });

        return back()->with('status', 'Expense added.');
    }

    public function updateExpense(Request $request, Expense $expense): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'expense_category_id' => ['required', 'integer', 'exists:expense_categories,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'spent_on' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'payment_channel' => ['required', 'in:cash,debit_card,credit_card'],
            'debit_card_id' => ['nullable', 'required_if:payment_channel,debit_card', 'integer', 'exists:debit_cards,id'],
            'credit_card_id' => ['nullable', 'required_if:payment_channel,credit_card', 'integer', 'exists:credit_cards,id'],
            'is_emi' => ['nullable', 'boolean'],
        ]);
        $data = $this->normalizeAccountLinkData($data);

        DB::transaction(function () use ($expense, $data): void {
            $original = clone $expense;
            $this->revertExpenseImpact($original);
            $expense->update($data);
            $expense->refresh();
            $this->applyExpenseImpact($expense);
        });

        return back()->with('status', 'Expense updated.');
    }

    public function deleteExpense(Expense $expense): RedirectResponse
    {
        DB::transaction(function () use ($expense): void {
            $this->revertExpenseImpact($expense);
            $expense->delete();
        });

        return back()->with('status', 'Expense deleted.');
    }

    public function storeIncome(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'source' => ['nullable', 'string', 'max:150'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'received_on' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'payment_channel' => ['required', 'in:cash,debit_card,credit_card'],
            'debit_card_id' => ['nullable', 'required_if:payment_channel,debit_card', 'integer', 'exists:debit_cards,id'],
            'credit_card_id' => ['nullable', 'required_if:payment_channel,credit_card', 'integer', 'exists:credit_cards,id'],
        ]);
        $data = $this->normalizeAccountLinkData($data);

        DB::transaction(function () use ($data): void {
            $income = Income::query()->create($data);
            $this->applyIncomeImpact($income);
        });

        return back()->with('status', 'Income added.');
    }

    public function updateIncome(Request $request, Income $income): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'source' => ['nullable', 'string', 'max:150'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'received_on' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'payment_channel' => ['required', 'in:cash,debit_card,credit_card'],
            'debit_card_id' => ['nullable', 'required_if:payment_channel,debit_card', 'integer', 'exists:debit_cards,id'],
            'credit_card_id' => ['nullable', 'required_if:payment_channel,credit_card', 'integer', 'exists:credit_cards,id'],
        ]);
        $data = $this->normalizeAccountLinkData($data);

        DB::transaction(function () use ($income, $data): void {
            $original = clone $income;
            $this->revertIncomeImpact($original);
            $income->update($data);
            $income->refresh();
            $this->applyIncomeImpact($income);
        });

        return back()->with('status', 'Income updated.');
    }

    public function deleteIncome(Income $income): RedirectResponse
    {
        DB::transaction(function () use ($income): void {
            $this->revertIncomeImpact($income);
            $income->delete();
        });

        return back()->with('status', 'Income deleted.');
    }

    public function storeCreditCard(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'total_limit' => ['required', 'numeric', 'min:0'],
            'used_amount' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        CreditCard::query()->create($data);

        return back()->with('status', 'Credit card added.');
    }

    public function updateCreditCard(Request $request, CreditCard $creditCard): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'total_limit' => ['required', 'numeric', 'min:0'],
            'used_amount' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $creditCard->update($data);

        return back()->with('status', 'Credit card updated.');
    }

    public function deleteCreditCard(CreditCard $creditCard): RedirectResponse
    {
        $creditCard->delete();

        return back()->with('status', 'Credit card deleted.');
    }

    public function storeDebitCard(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'bank_name' => ['nullable', 'string', 'max:150'],
            'current_balance' => ['required', 'numeric'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $data['total_limit'] = $data['current_balance'];
        DebitCard::query()->create($data);

        return back()->with('status', 'Debit card added.');
    }

    public function updateDebitCard(Request $request, DebitCard $debitCard): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'bank_name' => ['nullable', 'string', 'max:150'],
            'current_balance' => ['required', 'numeric'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $data['total_limit'] = $data['current_balance'];
        $debitCard->update($data);

        return back()->with('status', 'Debit card updated.');
    }

    public function deleteDebitCard(DebitCard $debitCard): RedirectResponse
    {
        $debitCard->delete();

        return back()->with('status', 'Debit card deleted.');
    }

    public function storeStock(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'symbol' => ['nullable', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:150'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'current_value' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        StockHolding::query()->create($data);

        return back()->with('status', 'Stock holding added.');
    }

    public function updateStock(Request $request, StockHolding $stock): RedirectResponse
    {
        $data = $request->validate([
            'symbol' => ['nullable', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:150'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'current_value' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $stock->update($data);

        return back()->with('status', 'Stock holding updated.');
    }

    public function deleteStock(StockHolding $stock): RedirectResponse
    {
        $stock->delete();

        return back()->with('status', 'Stock holding deleted.');
    }

    public function storeSavingsAdjustment(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric'],
            'adjusted_on' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        SavingsAdjustment::query()->create($data);

        return back()->with('status', 'Savings adjustment added.');
    }

    public function updateSavingsAdjustment(Request $request, SavingsAdjustment $adjustment): RedirectResponse
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric'],
            'adjusted_on' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $adjustment->update($data);

        return back()->with('status', 'Savings adjustment updated.');
    }

    public function deleteSavingsAdjustment(SavingsAdjustment $adjustment): RedirectResponse
    {
        $adjustment->delete();

        return back()->with('status', 'Savings adjustment deleted.');
    }

    public function storeNetWorth(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'year' => ['required', 'integer', 'min:2000', 'max:2100', 'unique:net_worth_entries,year'],
            'assets' => ['required', 'numeric', 'min:0'],
            'liabilities' => ['required', 'numeric', 'min:0'],
        ]);

        NetWorthEntry::query()->create($data);

        return back()->with('status', 'Net worth entry added.');
    }

    public function updateNetWorth(Request $request, NetWorthEntry $entry): RedirectResponse
    {
        $data = $request->validate([
            'year' => ['required', 'integer', 'min:2000', 'max:2100', 'unique:net_worth_entries,year,' . $entry->id],
            'assets' => ['required', 'numeric', 'min:0'],
            'liabilities' => ['required', 'numeric', 'min:0'],
        ]);

        $entry->update($data);

        return back()->with('status', 'Net worth entry updated.');
    }

    public function deleteNetWorth(NetWorthEntry $entry): RedirectResponse
    {
        $entry->delete();

        return back()->with('status', 'Net worth entry deleted.');
    }

    public function storeWeightLog(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'logged_on' => ['required', 'date', 'unique:weight_logs,logged_on'],
            'weight_kg' => ['required', 'numeric', 'min:20', 'max:300'],
            'did_walk' => ['nullable', 'boolean'],
            'walk_km' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'calories_intake' => ['nullable', 'integer', 'min:0', 'max:15000'],
            'breakfast_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'lunch_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'dinner_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'snacks_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'breakfast_carbs_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'lunch_carbs_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'dinner_carbs_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'snacks_carbs_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'breakfast_protein_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'lunch_protein_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'dinner_protein_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'snacks_protein_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'breakfast_fat_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'lunch_fat_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'dinner_fat_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'snacks_fat_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'carbs_g' => ['nullable', 'numeric', 'min:0', 'max:2000'],
            'protein_g' => ['nullable', 'numeric', 'min:0', 'max:2000'],
            'fat_g' => ['nullable', 'numeric', 'min:0', 'max:2000'],
            'intake_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $data['did_walk'] = (bool) ($data['did_walk'] ?? false);
        if (!$data['did_walk']) {
            $data['walk_km'] = null;
        }
        $data['calories_intake'] = $this->resolveCaloriesIntake($data);
        $data['carbs_g'] = $this->resolveMacroIntake($data, 'carbs_g');
        $data['protein_g'] = $this->resolveMacroIntake($data, 'protein_g');
        $data['fat_g'] = $this->resolveMacroIntake($data, 'fat_g');
        $this->clearMealNutritionFields($data);

        WeightLog::query()->create($data);

        return back()->with('status', 'Weight entry saved.');
    }

    public function updateWeightLog(Request $request, WeightLog $weightLog): RedirectResponse
    {
        $data = $request->validate([
            'logged_on' => ['required', 'date', 'unique:weight_logs,logged_on,' . $weightLog->id],
            'weight_kg' => ['required', 'numeric', 'min:20', 'max:300'],
            'did_walk' => ['nullable', 'boolean'],
            'walk_km' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'calories_intake' => ['nullable', 'integer', 'min:0', 'max:15000'],
            'breakfast_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'lunch_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'dinner_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'snacks_calories' => ['nullable', 'integer', 'min:0', 'max:5000'],
            'breakfast_carbs_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'lunch_carbs_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'dinner_carbs_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'snacks_carbs_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'breakfast_protein_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'lunch_protein_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'dinner_protein_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'snacks_protein_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'breakfast_fat_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'lunch_fat_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'dinner_fat_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'snacks_fat_g' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'carbs_g' => ['nullable', 'numeric', 'min:0', 'max:2000'],
            'protein_g' => ['nullable', 'numeric', 'min:0', 'max:2000'],
            'fat_g' => ['nullable', 'numeric', 'min:0', 'max:2000'],
            'intake_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $data['did_walk'] = (bool) ($data['did_walk'] ?? false);
        if (!$data['did_walk']) {
            $data['walk_km'] = null;
        }
        $data['calories_intake'] = $this->resolveCaloriesIntake($data);
        $data['carbs_g'] = $this->resolveMacroIntake($data, 'carbs_g');
        $data['protein_g'] = $this->resolveMacroIntake($data, 'protein_g');
        $data['fat_g'] = $this->resolveMacroIntake($data, 'fat_g');
        $this->clearMealNutritionFields($data);

        $weightLog->update($data);

        return back()->with('status', 'Weight entry updated.');
    }

    public function deleteWeightLog(WeightLog $weightLog): RedirectResponse
    {
        $weightLog->delete();

        return back()->with('status', 'Weight entry deleted.');
    }

    public function updateCashBalance(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'current_balance' => ['required', 'numeric'],
        ]);

        DB::transaction(function () use ($data): void {
            $row = CashBalance::query()->lockForUpdate()->first();
            if (!$row) {
                CashBalance::query()->create(['current_balance' => $data['current_balance']]);

                return;
            }
            $row->current_balance = $data['current_balance'];
            $row->save();
        });

        return back()->with('status', 'Cash in hand balance updated.');
    }

    private function normalizeAccountLinkData(array $data): array
    {
        $channel = $data['payment_channel'] ?? 'cash';
        $data['debit_card_id'] = $channel === 'debit_card' ? ($data['debit_card_id'] ?? null) : null;
        $data['credit_card_id'] = $channel === 'credit_card' ? ($data['credit_card_id'] ?? null) : null;
        $data['is_emi'] = (bool) ($data['is_emi'] ?? false);

        return $data;
    }

    private function applyExpenseImpact(Expense $expense): void
    {
        $amount = (float) $expense->amount;
        if ($amount <= 0) {
            return;
        }

        if ($expense->payment_channel === 'credit_card' && $expense->credit_card_id) {
            $this->adjustCreditUsedAmount((int) $expense->credit_card_id, $amount);
        }

        if ($expense->payment_channel === 'debit_card' && $expense->debit_card_id) {
            $this->adjustDebitBalance((int) $expense->debit_card_id, -$amount);
        }

        if ($expense->payment_channel === 'cash') {
            $this->adjustCashBalance(-$amount);
        }
    }

    private function revertExpenseImpact(Expense $expense): void
    {
        $amount = (float) $expense->amount;
        if ($amount <= 0) {
            return;
        }

        if ($expense->payment_channel === 'credit_card' && $expense->credit_card_id) {
            $this->adjustCreditUsedAmount((int) $expense->credit_card_id, -$amount);
        }

        if ($expense->payment_channel === 'debit_card' && $expense->debit_card_id) {
            $this->adjustDebitBalance((int) $expense->debit_card_id, $amount);
        }

        if ($expense->payment_channel === 'cash') {
            $this->adjustCashBalance($amount);
        }
    }

    private function applyIncomeImpact(Income $income): void
    {
        $amount = (float) $income->amount;
        if ($amount <= 0) {
            return;
        }

        if ($income->payment_channel === 'debit_card' && $income->debit_card_id) {
            $this->adjustDebitBalance((int) $income->debit_card_id, $amount);
        }

        if ($income->payment_channel === 'credit_card' && $income->credit_card_id) {
            $this->adjustCreditUsedAmount((int) $income->credit_card_id, -$amount);
        }

        if ($income->payment_channel === 'cash') {
            $this->adjustCashBalance($amount);
        }
    }

    private function revertIncomeImpact(Income $income): void
    {
        $amount = (float) $income->amount;
        if ($amount <= 0) {
            return;
        }

        if ($income->payment_channel === 'debit_card' && $income->debit_card_id) {
            $this->adjustDebitBalance((int) $income->debit_card_id, -$amount);
        }

        if ($income->payment_channel === 'credit_card' && $income->credit_card_id) {
            $this->adjustCreditUsedAmount((int) $income->credit_card_id, $amount);
        }

        if ($income->payment_channel === 'cash') {
            $this->adjustCashBalance(-$amount);
        }
    }

    private function adjustCashBalance(float $delta): void
    {
        $row = CashBalance::query()->lockForUpdate()->first();
        if (!$row) {
            CashBalance::query()->create(['current_balance' => $delta]);

            return;
        }

        $row->current_balance = (float) $row->current_balance + $delta;
        $row->save();
    }

    private function adjustDebitBalance(int $debitCardId, float $delta): void
    {
        $card = DebitCard::query()->lockForUpdate()->find($debitCardId);
        if (!$card) {
            return;
        }

        $card->current_balance = (float) $card->current_balance + $delta;
        $card->save();
    }

    private function adjustCreditUsedAmount(int $creditCardId, float $delta): void
    {
        $card = CreditCard::query()->lockForUpdate()->find($creditCardId);
        if (!$card) {
            return;
        }

        $card->used_amount = max(0, (float) $card->used_amount + $delta);
        $card->save();
    }

    private function resolveDateRange(string $period, int $selectedYear): array
    {
        $today = now();
        if ($period === 'week') {
            return [$today->copy()->startOfWeek(), $today->copy()->endOfWeek()];
        }

        if ($period === 'year') {
            $yearBase = Carbon::create($selectedYear, 1, 1);
            return [$yearBase->copy()->startOfYear(), $yearBase->copy()->endOfYear()];
        }

        return [$today->copy()->startOfMonth(), $today->copy()->endOfMonth()];
    }

    private function filteredExpenseQuery(Carbon $startDate, Carbon $endDate)
    {
        return Expense::query()
            ->whereBetween('spent_on', [$startDate->toDateString(), $endDate->toDateString()]);
    }

    /**
     * Monthly and cumulative cash-flow from incomes and expenses, with forecasts for
     * the current partial month and future months so charts are never empty-looking.
     *
     * @return array<string, mixed>
     */
    private function buildNetWorthMonthlyAnalysis(int $year): array
    {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $now = now();

        $rawMonthly = [];
        $hasDataByMonth = [];
        for ($month = 1; $month <= 12; $month++) {
            $rawMonthly[] = $this->monthNetActual($year, $month);
            $hasDataByMonth[] = $this->monthHasAnyData($year, $month);
        }

        $avgNet = $this->pickAverageMonthlyNetForForecast($year, $now, $rawMonthly);

        $monthlyNet = [];
        $monthlyKinds = [];
        for ($month = 1; $month <= 12; $month++) {
            [$value, $kind] = $this->blendMonthlyNetWithForecast($year, $month, $rawMonthly[$month - 1], $avgNet, $now);
            $monthlyNet[] = $value;
            $monthlyKinds[] = $kind;
        }

        $cumulativeFlow = $this->buildForecastCumulativeSeries($year, $monthlyNet, $now);

        $thisMonthStart = $now->copy()->startOfMonth();
        $nextMonthStart = $now->copy()->addMonth()->startOfMonth();
        $forecastThis = $this->forecastFullMonthAmount(
            (int) $thisMonthStart->year,
            (int) $thisMonthStart->month,
            $now,
            $avgNet
        );
        $forecastNext = $this->forecastFullMonthAmount(
            (int) $nextMonthStart->year,
            (int) $nextMonthStart->month,
            $now,
            $avgNet
        );

        $confidenceNote = $avgNet !== 0.0
            ? 'Forecast uses your recent monthly net (last up to 12 closed months, or same-year completed months when enough data). It refines as you add more entries.'
            : 'Add a few months of income and expense data to unlock smarter forecasts; showing zeros until then.';

        $startMonth = $this->resolveNetWorthStartMonth($year, $now, $hasDataByMonth);
        $startIdx = max(0, $startMonth - 1);

        return [
            'year' => $year,
            'labels' => array_slice($labels, $startIdx),
            'monthly_net' => array_slice($monthlyNet, $startIdx),
            'monthly_kinds' => array_slice($monthlyKinds, $startIdx),
            'cumulative_flow' => array_slice($cumulativeFlow, $startIdx),
            'forecast' => [
                'this_month_label' => $thisMonthStart->format('F Y'),
                'this_month_rs' => $forecastThis,
                'next_month_label' => $nextMonthStart->format('F Y'),
                'next_month_rs' => $forecastNext,
                'avg_monthly_net_rs' => $avgNet,
                'confidence_note' => $confidenceNote,
            ],
        ];
    }

    private function monthHasAnyData(int $year, int $month): bool
    {
        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end = Carbon::create($year, $month, 1)->endOfMonth();

        $incomeCount = Income::query()
            ->whereBetween('received_on', [$start->toDateString(), $end->toDateString()])
            ->count();
        $expenseCount = Expense::query()
            ->whereBetween('spent_on', [$start->toDateString(), $end->toDateString()])
            ->count();

        return ($incomeCount + $expenseCount) > 0;
    }

    /**
     * Find first month to display in the series.
     * - Start from first month that has actual entries.
     * - If no month has entries in current year, start at current month.
     * - For years with no data and not current year, keep from Jan.
     */
    private function resolveNetWorthStartMonth(int $year, Carbon $now, array $hasDataByMonth): int
    {
        foreach ($hasDataByMonth as $idx => $hasData) {
            if ($hasData) {
                return $idx + 1;
            }
        }

        if ($year === (int) $now->year) {
            return (int) $now->month;
        }

        return 1;
    }

    private function monthNetActual(int $year, int $month): float
    {
        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end = Carbon::create($year, $month, 1)->endOfMonth();

        $incomeMonth = (float) Income::query()
            ->whereBetween('received_on', [$start->toDateString(), $end->toDateString()])
            ->sum('amount');
        $expenseMonth = (float) Expense::query()
            ->whereBetween('spent_on', [$start->toDateString(), $end->toDateString()])
            ->sum('amount');

        return round($incomeMonth - $expenseMonth, 2);
    }

    private function monthNetPartialThrough(int $year, int $month, Carbon $through): float
    {
        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end = Carbon::create($year, $month, 1)->endOfMonth();
        $throughDate = min($through->toDateString(), $end->toDateString());

        $incomePart = (float) Income::query()
            ->whereBetween('received_on', [$start->toDateString(), $throughDate])
            ->sum('amount');
        $expensePart = (float) Expense::query()
            ->whereBetween('spent_on', [$start->toDateString(), $throughDate])
            ->sum('amount');

        return round($incomePart - $expensePart, 2);
    }

    private function allTimeNetAtEndOfDate(Carbon $date): float
    {
        $d = $date->toDateString();

        return round(
            (float) Income::query()->where('received_on', '<=', $d)->sum('amount')
            - (float) Expense::query()->where('spent_on', '<=', $d)->sum('amount'),
            2
        );
    }

    private function trailingAverageMonthlyNetClosedMonths(int $monthsBack): float
    {
        $cursor = now()->copy()->firstOfMonth()->subMonth();
        $nets = [];
        for ($i = 0; $i < $monthsBack; $i++) {
            $nets[] = $this->monthNetActual((int) $cursor->year, (int) $cursor->month);
            $cursor->subMonth();
        }

        return $nets === [] ? 0.0 : round(array_sum($nets) / count($nets), 2);
    }

    private function sameYearCompletedAverage(int $year, int $beforeMonth): float
    {
        if ($beforeMonth <= 1) {
            return 0.0;
        }
        $sum = 0.0;
        $n = 0;
        for ($m = 1; $m < $beforeMonth; $m++) {
            $sum += $this->monthNetActual($year, $m);
            $n++;
        }

        return $n > 0 ? round($sum / $n, 2) : 0.0;
    }

    private function pickAverageMonthlyNetForForecast(int $year, Carbon $now, array $rawMonthly): float
    {
        $y = (int) $now->year;
        $trailing = $this->trailingAverageMonthlyNetClosedMonths(12);

        if ($year < $y) {
            $sum = array_sum($rawMonthly);

            return round($sum / 12, 2);
        }

        if ($year > $y) {
            return $trailing;
        }

        $inYearAvg = $this->sameYearCompletedAverage($year, (int) $now->month);
        if ($now->month > 2 && $inYearAvg !== 0.0) {
            return $inYearAvg;
        }

        return $trailing !== 0.0 ? $trailing : $inYearAvg;
    }

    /**
     * @return array{0: float, 1: 'actual'|'blend'|'forecast'}
     */
    private function blendMonthlyNetWithForecast(int $year, int $month, float $rawFullMonth, float $avgNet, Carbon $now): array
    {
        $monthStart = Carbon::create($year, $month, 1)->startOfMonth();
        $monthEnd = Carbon::create($year, $month, 1)->endOfMonth();
        $currentMonthStart = $now->copy()->startOfMonth();

        if ($monthEnd->lt($currentMonthStart) || $year < (int) $now->year) {
            return [$rawFullMonth, 'actual'];
        }

        if ($year > (int) $now->year) {
            $v = $avgNet !== 0.0 ? $avgNet : $rawFullMonth;

            return [round($v, 2), 'forecast'];
        }

        if ($month > (int) $now->month) {
            $v = $avgNet !== 0.0 ? $avgNet : $rawFullMonth;

            return [round($v, 2), 'forecast'];
        }

        $daysInMonth = $monthEnd->daysInMonth;
        $remaining = max(0, $daysInMonth - (int) $now->day);
        $partial = $this->monthNetPartialThrough($year, $month, $now);
        $daily = $avgNet / max(1, $daysInMonth);
        $projected = $partial + $daily * $remaining;

        return [round($projected, 2), 'blend'];
    }

    private function forecastFullMonthAmount(int $year, int $month, Carbon $now, float $avgNet): float
    {
        $monthStart = Carbon::create($year, $month, 1)->startOfMonth();
        if ($monthStart->gt($now->copy()->startOfMonth())) {
            return round($avgNet !== 0.0 ? $avgNet : $this->monthNetActual($year, $month), 2);
        }

        if ($monthStart->equalTo($now->copy()->startOfMonth())) {
            [$v] = $this->blendMonthlyNetWithForecast($year, $month, $this->monthNetActual($year, $month), $avgNet, $now);

            return $v;
        }

        return round($this->monthNetActual($year, $month), 2);
    }

    /**
     * @param list<float> $monthlyNet
     * @return list<float>
     */
    private function buildForecastCumulativeSeries(int $year, array $monthlyNet, Carbon $now): array
    {
        $out = [];
        $run = null;

        for ($month = 1; $month <= 12; $month++) {
            $monthStart = Carbon::create($year, $month, 1)->startOfMonth();
            $monthEnd = Carbon::create($year, $month, 1)->endOfMonth();
            $currentMonthStart = $now->copy()->startOfMonth();

            if ($monthEnd->lt($currentMonthStart) || $year < (int) $now->year) {
                $out[] = $this->allTimeNetAtEndOfDate($monthEnd);
                $run = $out[count($out) - 1];
                continue;
            }

            if ($run === null) {
                if ($year > (int) $now->year && $month === 1) {
                    $run = $this->allTimeNetAtEndOfDate($now->copy()->startOfDay());
                } else {
                    $run = $this->allTimeNetAtEndOfDate($monthStart->copy()->subDay());
                }
            }

            $run += $monthlyNet[$month - 1];
            $out[] = round((float) $run, 2);
        }

        return $out;
    }

    private function resolveCaloriesIntake(array $data): ?int
    {
        $mealFields = ['breakfast_calories', 'lunch_calories', 'dinner_calories', 'snacks_calories'];
        $hasMealValue = false;
        $mealTotal = 0;

        foreach ($mealFields as $field) {
            if (!array_key_exists($field, $data) || $data[$field] === null || $data[$field] === '') {
                continue;
            }

            $hasMealValue = true;
            $mealTotal += (int) $data[$field];
        }

        if ($hasMealValue) {
            return $mealTotal;
        }

        if (array_key_exists('calories_intake', $data) && $data['calories_intake'] !== null && $data['calories_intake'] !== '') {
            return (int) $data['calories_intake'];
        }

        return null;
    }

    private function resolveMacroIntake(array $data, string $macroKey): ?float
    {
        $prefixes = ['breakfast', 'lunch', 'dinner', 'snacks'];
        $hasMealValue = false;
        $total = 0.0;

        foreach ($prefixes as $prefix) {
            $field = $prefix . '_' . $macroKey;
            if (!array_key_exists($field, $data) || $data[$field] === null || $data[$field] === '') {
                continue;
            }

            $hasMealValue = true;
            $total += (float) $data[$field];
        }

        if ($hasMealValue) {
            return round($total, 2);
        }

        if (array_key_exists($macroKey, $data) && $data[$macroKey] !== null && $data[$macroKey] !== '') {
            return round((float) $data[$macroKey], 2);
        }

        return null;
    }

    private function clearMealNutritionFields(array &$data): void
    {
        $fields = [
            'breakfast_calories', 'lunch_calories', 'dinner_calories', 'snacks_calories',
            'breakfast_carbs_g', 'lunch_carbs_g', 'dinner_carbs_g', 'snacks_carbs_g',
            'breakfast_protein_g', 'lunch_protein_g', 'dinner_protein_g', 'snacks_protein_g',
            'breakfast_fat_g', 'lunch_fat_g', 'dinner_fat_g', 'snacks_fat_g',
        ];

        foreach ($fields as $field) {
            unset($data[$field]);
        }
    }
}
