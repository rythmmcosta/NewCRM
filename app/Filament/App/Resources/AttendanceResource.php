<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('My Attendance Details')
                    ->schema([
                        View::make('filament.resources.attendance.timeline')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('clock_in')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('clock_out')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'on_break' => 'warning',
                        'completed' => 'gray',
                        default => 'primary',
                    }),
                Tables\Columns\TextColumn::make('total_hours')
                    ->numeric()
                    ->sortable(),
            ])
            ->actions([
                Action::make('timeline')
                    ->label('Timeline')
                    ->color('info')
                    ->icon('heroicon-o-presentation-chart-line')
                    ->modalContent(fn (Attendance $record) => view('filament.resources.attendance.timeline', ['attendance' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close'),
                ViewAction::make(),
            ])
;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
            'view' => Pages\ViewAttendance::route('/{record}'),
        ];
    }
}
