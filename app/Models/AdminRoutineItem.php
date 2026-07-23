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
        if ($this->end_time !== null && $this->end_time !== '') {
            return $this->formatClockTime($this->end_time);
        }

        return $this->formatMinutesAsClock($this->clockToMinutes($this->scheduled_time) + 60);
    }

    public function spansMidnight(): bool
    {
        if ($this->end_time === null || $this->end_time === '') {
            return false;
        }

        return $this->clockToMinutes($this->end_time) <= $this->clockToMinutes($this->scheduled_time);
    }

    public function durationMinutes(): int
    {
        $start = $this->clockToMinutes($this->scheduled_time);
        if ($this->end_time === null || $this->end_time === '') {
            return 60;
        }

        $end = $this->clockToMinutes($this->end_time);
        if ($end === $start) {
            return 0;
        }

        if ($end < $start) {
            return (24 * 60) - $start + $end;
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

    public function durationLabelWithOvernightHint(): string
    {
        $label = $this->durationLabel();
        if ($this->spansMidnight()) {
            return $label . ' (overnight)';
        }

        return $label;
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

    private function formatMinutesAsClock(int $minutes): string
    {
        $minutes = (($minutes % (24 * 60)) + (24 * 60)) % (24 * 60);

        return sprintf('%02d:%02d', intdiv($minutes, 60), $minutes % 60);
    }
}
