<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('designation')
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('User Account')
                    ->placeholder('No Account'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                Action::make('createUser')
                    ->label('Create User')
                    ->icon('heroicon-o-user-plus')
                    ->color('success')
                    ->hidden(fn (Employee $record) => $record->user_id !== null)
                    ->form([
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->minLength(8),
                    ])
                    ->action(function (Employee $record, array $data) {
                        $user = User::create([
                            'name' => $record->name,
                            'email' => $record->email,
                            'password' => Hash::make($data['password']),
                        ]);

                        $record->user_id = $user->id;
                        $record->save();

                        Notification::make()
                            ->title('User Account Created')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
