<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'clock_in',
        'clock_out',
        'breaks',
        'status',
        'total_hours',
    ];

    protected $casts = [
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
        'breaks' => 'array',
        'date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTimelineData(): array
    {
        return $this->events()->toArray();
    }

    public function events()
    {
        $events = collect();

        if ($this->clock_in) {
            $events->push([
                'id' => 'clock_in',
                'title' => 'Clocked In',
                'time' => $this->clock_in,
                'description' => 'Shift started',
                'icon' => 'heroicon-m-play',
                'color' => 'success',
            ]);
        }

        $breaks = $this->breaks ?? [];
        foreach ($breaks as $index => $break) {
            $events->push([
                'id' => 'break_start_' . $index,
                'title' => 'Break Started',
                'time' => Carbon::parse($break['start']),
                'description' => 'Break session ' . ($index + 1),
                'icon' => 'heroicon-m-pause',
                'color' => 'warning',
            ]);

            if (isset($break['end']) && $break['end']) {
                $events->push([
                    'id' => 'break_end_' . $index,
                    'title' => 'Break Ended',
                    'time' => Carbon::parse($break['end']),
                    'description' => 'Returned from break',
                    'icon' => 'heroicon-m-play',
                    'color' => 'success',
                ]);
            }
        }

        if ($this->clock_out) {
            $events->push([
                'id' => 'clock_out',
                'title' => 'Clocked Out',
                'time' => $this->clock_out,
                'description' => 'Shift ended. Total: ' . $this->total_hours . ' hours',
                'icon' => 'heroicon-m-stop',
                'color' => 'danger',
            ]);
        }

        return $events->sortBy('time');
    }
}
