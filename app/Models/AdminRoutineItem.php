<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRoutineItem extends Model
{
    protected $fillable = [
        'user_id',
        'routine_date',
        'scheduled_time',
        'end_time',
        'title',
        'details',
        'is_done',
        'order_index',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'routine_date' => 'date',
            'is_done' => 'boolean',
            'order_index' => 'integer',
        ];
    }

    public function startTimeLabel(): string
    {
        return $this->formatClockTime($this->scheduled_time);
    }

    public function endTimeLabel(): string
    {
        return $this->formatClockTime($this->end_time ?: $this->scheduled_time);
    }

    public function durationMinutes(): int
    {
        $start = $this->clockToMinutes($this->scheduled_time);
        $end = $this->clockToMinutes($this->end_time ?: $this->scheduled_time);

        if ($end <= $start) {
            return max(0, (24 * 60) - $start + $end);
        }

        return $end - $start;
    }

    public function durationLabel(): string
    {
        $minutes = $this->durationMinutes();
        if ($minutes <= 0) {
            return '0 min';
        }

        $hours = intdiv($minutes, 60);
        $remaining = $minutes % 60;

        if ($hours === 0) {
            return $minutes . ' min';
        }

        if ($remaining === 0) {
            return $hours . 'h';
        }

        return $hours . 'h ' . $remaining . 'm';
    }

    private function formatClockTime(?string $value): string
    {
        $normalized = substr((string) $value, 0, 5);
        if (!preg_match('/^\d{2}:\d{2}$/', $normalized)) {
            return '--:--';
        }

        return $normalized;
    }

    private function clockToMinutes(?string $value): int
    {
        $normalized = substr((string) $value, 0, 5);
        if (!preg_match('/^(\d{2}):(\d{2})$/', $normalized, $matches)) {
            return 0;
        }

        return ((int) $matches[1] * 60) + (int) $matches[2];
    }
}
