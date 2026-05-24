<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Employee Details')
                    ->tabs([
                        Tab::make('Personal Info')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('name')
                                            ->required(),
                                        TextInput::make('father_name')
                                            ->label('Father\'s Name'),
                                        DatePicker::make('dob')
                                            ->label('Date of Birth'),
                                        Select::make('gender')
                                            ->options([
                                                'male' => 'Male',
                                                'female' => 'Female',
                                                'other' => 'Other',
                                            ]),
                                        Select::make('marital_status')
                                            ->options([
                                                'single' => 'Single',
                                                'married' => 'Married',
                                                'divorced' => 'Divorced',
                                                'widowed' => 'Widowed',
                                            ]),
                                        TextInput::make('blood_group')
                                            ->label('Blood Group'),
                                        TextInput::make('nationality')
                                            ->default('Bangladeshi'),
                                        TextInput::make('nid_number')
                                            ->label('NID / Passport No'),
                                    ]),
                            ]),
                        Tab::make('Contact')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('email')
                                            ->email()
                                            ->required(),
                                        TextInput::make('phone')
                                            ->tel()
                                            ->label('Mobile No'),
                                        TextInput::make('telephone')
                                            ->tel()
                                            ->label('Telephone'),
                                        Textarea::make('correspondence_address')
                                            ->label('Correspondence Address'),
                                        Textarea::make('permanent_address')
                                            ->label('Permanent Address'),
                                    ]),
                                Section::make('Emergency Contact')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('emergency_contact.name')
                                                    ->label('Name'),
                                                TextInput::make('emergency_contact.relation')
                                                    ->label('Relation'),
                                                TextInput::make('emergency_contact.contact_no')
                                                    ->label('Contact No'),
                                            ]),
                                    ]),
                            ]),
                        Tab::make('Job Details')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('designation'),
                                        DatePicker::make('joining_date'),
                                        Select::make('roles')
                                            ->relationship('roles', 'name')
                                            ->multiple()
                                            ->preload(),
                                    ]),
                            ]),
                        Tab::make('Education')
                            ->schema([
                                Repeater::make('educational_details')
                                    ->label('Educational Details')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('degree')->required(),
                                                TextInput::make('university')->label('University / Institute'),
                                                TextInput::make('specialization'),
                                                DatePicker::make('from_date'),
                                                DatePicker::make('to_date'),
                                                TextInput::make('grade')->label('Percentage / Grade'),
                                            ]),
                                    ])
                                    ->columns(1),
                            ]),
                        Tab::make('Experience')
                            ->schema([
                                Repeater::make('employment_details')
                                    ->label('Employment Details')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('organisation'),
                                                TextInput::make('designation'),
                                                DatePicker::make('from_date'),
                                                DatePicker::make('to_date'),
                                                TextInput::make('annual_ctc')->label('Annual CTC'),
                                            ]),
                                    ])
                                    ->columns(1),
                            ]),
                        Tab::make('Family & Refs')
                            ->schema([
                                Repeater::make('family_details')
                                    ->label('Family Details')
                                    ->schema([
                                        Grid::make(4)
                                            ->schema([
                                                TextInput::make('name'),
                                                TextInput::make('relation'),
                                                TextInput::make('occupation'),
                                                TextInput::make('contact_no'),
                                            ]),
                                    ]),
                                Repeater::make('professional_references')
                                    ->label('Professional References')
                                    ->schema([
                                        Grid::make(4)
                                            ->schema([
                                                TextInput::make('name'),
                                                TextInput::make('organisation'),
                                                TextInput::make('designation'),
                                                TextInput::make('contact_no'),
                                            ]),
                                    ])
                                    ->maxItems(2),
                            ]),
                        Tab::make('Declaration')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        DatePicker::make('declaration_date'),
                                        TextInput::make('declaration_place'),
                                        FileUpload::make('photograph')
                                            ->image()
                                            ->directory('employees/photographs'),
                                        FileUpload::make('signature')
                                            ->image()
                                            ->directory('employees/signatures'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
