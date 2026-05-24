<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\Task;
use Guava\Calendar\Filament\CalendarWidget;
use Illuminate\Support\Collection;
use Guava\Calendar\ValueObjects\CalendarEvent;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use Guava\Calendar\ValueObjects\FetchInfo;
use Illuminate\Database\Eloquent\Builder;

class MainCalendarWidget extends CalendarWidget
{
    protected HtmlString|string|bool|null $heading = 'Calendar';

    public function getEvents(FetchInfo $info): Collection|Builder|array
    {
        $events = collect();

        // Holidays
        Holiday::where('is_global', true)
            ->get()
            ->each(function (Holiday $holiday) use ($events) {
                $events->push(
                    CalendarEvent::make($holiday)
                        ->title($holiday->name)
                        ->start($holiday->date)
                        ->end($holiday->date)
                        ->allDay()
                        ->backgroundColor('#fbbf24') // Amber
                );
            });

        // Specific Holidays
        Holiday::where('is_global', false)
            ->whereJsonContains('employee_ids', (string) auth()->id())
            ->get()
            ->each(function (Holiday $holiday) use ($events) {
                $events->push(
                    CalendarEvent::make($holiday)
                        ->title($holiday->name)
                        ->start($holiday->date)
                        ->end($holiday->date)
                        ->allDay()
                        ->backgroundColor('#fbbf24') // Amber
                );
            });

        // Leaves
        Leave::where('status', 'approved')
            ->get()
            ->each(function (Leave $leave) use ($events) {
                $events->push(
                    CalendarEvent::make($leave)
                        ->title($leave->user->name . ' - ' . $leave->type)
                        ->start($leave->start_date)
                        ->end($leave->end_date)
                        ->allDay()
                        ->backgroundColor('#f87171') // Red
                );
            });

        // Tasks
        Task::where('user_id', auth()->id())
            ->get()
            ->each(function (Task $task) use ($events) {
                $events->push(
                    CalendarEvent::make($task)
                        ->title('Task: ' . $task->title)
                        ->start($task->start_at)
                        ->end($task->end_at)
                        ->backgroundColor('#60a5fa') // Blue
                );
            });

        // Attendance
        Attendance::where('user_id', auth()->id())
            ->get()
            ->each(function (Attendance $attendance) use ($events) {
                $events->push(
                    CalendarEvent::make($attendance)
                        ->title('Attendance: ' . $attendance->clock_in->format('H:i'))
                        ->start($attendance->clock_in)
                        ->end($attendance->clock_out ?? now())
                        ->backgroundColor('#34d399') // Green
                );
            });

        return $events->toArray();
    }
}
