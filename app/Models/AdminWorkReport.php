<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminWorkReport extends Model
{
    protected $fillable = [
        'user_id',
        'report_date',
        'entry_type',
        'employee_name',
        'tasks',
        'extra_tasks',
        'message_snapshot',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'report_date' => 'date',
            'tasks' => 'array',
            'extra_tasks' => 'array',
        ];
    }

    public function allTasks(): array
    {
        $main = collect($this->tasks ?? [])
            ->map(static fn ($task) => trim((string) $task))
            ->filter()
            ->values()
            ->all();

        $extras = collect($this->extra_tasks ?? [])
            ->map(static fn ($task) => trim((string) $task))
            ->filter()
            ->values()
            ->all();

        return array_values(array_merge($main, $extras));
    }
}
