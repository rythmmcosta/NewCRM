<?php

use App\Models\Attendance;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Filament\Notifications\Notification;

new class extends Component
{
    public ?Attendance $attendance = null;

    public function mount()
    {
        $this->loadAttendance();
    }

    public function loadAttendance()
    {
        $this->attendance = Attendance::where('user_id', auth()->id())
            ->where('date', Carbon::today())
            ->where('status', '!=', 'completed')
            ->first();
    }

    public function clockIn()
    {
        if ($this->attendance) {
            return;
        }

        $this->attendance = Attendance::create([
            'user_id' => auth()->id(),
            'date' => Carbon::today(),
            'clock_in' => now(),
            'status' => 'active',
        ]);

        Notification::make()
            ->title('Clocked In Successfully')
            ->success()
            ->send();
            
        $this->dispatch('refresh-calendar');
    }

    public function toggleBreak()
    {
        if (!$this->attendance) {
            return;
        }

        $breaks = $this->attendance->breaks ?? [];

        if ($this->attendance->status === 'active') {
            $breaks[] = ['start' => now()->toDateTimeString(), 'end' => null];
            $this->attendance->status = 'on_break';
        } elseif ($this->attendance->status === 'on_break') {
            $lastIndex = count($breaks) - 1;
            if ($lastIndex >= 0) {
                $breaks[$lastIndex]['end'] = now()->toDateTimeString();
            }
            $this->attendance->status = 'active';
        }

        $this->attendance->breaks = $breaks;
        $this->attendance->save();

        Notification::make()
            ->title($this->attendance->status === 'on_break' ? 'Break Started' : 'Break Ended')
            ->info()
            ->send();
    }

    public function clockOut()
    {
        if (!$this->attendance || $this->attendance->status === 'completed') {
            return;
        }

        if ($this->attendance->status === 'on_break') {
            $this->toggleBreak();
        }

        $this->attendance->clock_out = now();
        $this->attendance->status = 'completed';

        $start = Carbon::parse($this->attendance->clock_in);
        $end = Carbon::parse($this->attendance->clock_out);
        $totalMinutes = $end->diffInMinutes($start);

        $breaks = $this->attendance->breaks ?? [];
        foreach ($breaks as $break) {
            if ($break['start'] && $break['end']) {
                $bStart = Carbon::parse($break['start']);
                $bEnd = Carbon::parse($break['end']);
                $totalMinutes -= $bEnd->diffInMinutes($bStart);
            }
        }

        $this->attendance->total_hours = round($totalMinutes / 60, 2);
        $this->attendance->save();

        Notification::make()
            ->title('Clocked Out Successfully')
            ->success()
            ->body("Total Hours: {$this->attendance->total_hours}")
            ->send();

        $this->attendance = null;
        $this->dispatch('refresh-calendar');
    }
};
?>

<div class="flex items-center gap-x-2">
    <div @class([
        'flex items-center gap-x-1 rounded-full p-1 shadow-sm ring-1 ring-inset',
        'bg-primary-50 ring-primary-600/20' => !$attendance,
        'bg-success-50 ring-success-600/20' => $attendance?->status === 'active',
        'bg-warning-50 ring-warning-600/20' => $attendance?->status === 'on_break',
    ])>
        @if (!$attendance)
            <button
                wire:click="clockIn"
                class="flex h-7 items-center gap-x-2 rounded-full bg-primary-600 px-3 text-xs font-bold text-white hover:bg-primary-500"
            >
                <x-filament::icon icon="heroicon-m-play" class="h-4 w-4" />
                Clock In
            </button>
        @else
            <div class="flex items-center gap-x-1 px-2 text-xs font-medium uppercase tracking-wider">
                <span @class([
                    'h-2 w-2 rounded-full animate-pulse',
                    'bg-success-600' => $attendance->status === 'active',
                    'bg-warning-600' => $attendance->status === 'on_break',
                ])></span>
                <span @class([
                    'text-success-700' => $attendance->status === 'active',
                    'text-warning-700' => $attendance->status === 'on_break',
                ])>
                    {{ $attendance->status === 'active' ? 'Active' : 'On Break' }}
                </span>
            </div>
            
            <x-filament::dropdown placement="bottom-end">
                <x-slot name="trigger">
                    <button class="flex h-7 w-7 items-center justify-center rounded-full bg-white text-gray-400 hover:text-gray-500 shadow-sm ring-1 ring-gray-950/10">
                        <x-filament::icon icon="heroicon-m-ellipsis-vertical" class="h-4 w-4" />
                    </button>
                </x-slot>

                <x-filament::dropdown.list>
                    <x-filament::dropdown.list.item
                        :icon="$attendance->status === 'on_break' ? 'heroicon-m-play-pause' : 'heroicon-m-pause'"
                        wire:click="toggleBreak"
                    >
                        {{ $attendance->status === 'on_break' ? 'End Break' : 'Start Break' }}
                    </x-filament::dropdown.list.item>

                    <x-filament::dropdown.list.item
                        icon="heroicon-m-stop"
                        wire:click="clockOut"
                        color="danger"
                    >
                        Clock Out
                    </x-filament::dropdown.list.item>
                </x-filament::dropdown.list>
            </x-filament::dropdown>
        @endif
    </div>
</div>
