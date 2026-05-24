<?php

namespace App\Livewire;

use App\Models\Attendance;
use Livewire\Component;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Devletes\FilamentTimelineView\Tables\Columns\TimelineEntry;

class AttendanceTimeline extends Component implements HasTable
{
    use InteractsWithTable;

    public Attendance $attendance;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => $this->attendance->events())
            ->columns([
                TimelineEntry::make()
                    ->title(fn ($record) => $record['title'])
                    ->content(fn ($record) => $record['description'])
                    ->time(fn ($record) => $record['time']),
            ])
            ->asTimeline();
    }

    public function render()
    {
        return <<<'BLADE'
            <div>
                {{ $this->table }}
            </div>
        BLADE;
    }
}
