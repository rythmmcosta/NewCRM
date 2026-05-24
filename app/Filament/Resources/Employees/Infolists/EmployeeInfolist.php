<?php

namespace App\Filament\Resources\Employees\Infolists;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class EmployeeInfolist
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
                                        TextEntry::make('name'),
                                        TextEntry::make('father_name')
                                            ->label('Father\'s Name'),
                                        TextEntry::make('dob')
                                            ->label('Date of Birth')
                                            ->date(),
                                        TextEntry::make('gender'),
                                        TextEntry::make('marital_status'),
                                        TextEntry::make('blood_group')
                                            ->label('Blood Group'),
                                        TextEntry::make('nationality'),
                                        TextEntry::make('nid_number')
                                            ->label('NID / Passport No'),
                                    ]),
                                ImageEntry::make('photograph')
                                    ->circular(),
                            ]),
                        Tab::make('Contact')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('email'),
                                        TextEntry::make('phone')
                                            ->label('Mobile No'),
                                        TextEntry::make('telephone')
                                            ->label('Telephone'),
                                        TextEntry::make('correspondence_address')
                                            ->label('Correspondence Address'),
                                        TextEntry::make('permanent_address')
                                            ->label('Permanent Address'),
                                    ]),
                                Section::make('Emergency Contact')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextEntry::make('emergency_contact.name')
                                                    ->label('Name'),
                                                TextEntry::make('emergency_contact.relation')
                                                    ->label('Relation'),
                                                TextEntry::make('emergency_contact.contact_no')
                                                    ->label('Contact No'),
                                            ]),
                                    ]),
                            ]),
                        Tab::make('Job Details')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('designation'),
                                        TextEntry::make('joining_date')
                                            ->date(),
                                        TextEntry::make('user.email')
                                            ->label('System User'),
                                    ]),
                            ]),
                        Tab::make('Education')
                            ->schema([
                                RepeatableEntry::make('educational_details')
                                    ->label('Educational Details')
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextEntry::make('degree'),
                                                TextEntry::make('university')->label('University / Institute'),
                                                TextEntry::make('specialization'),
                                                TextEntry::make('from_date')->date(),
                                                TextEntry::make('to_date')->date(),
                                                TextEntry::make('grade')->label('Percentage / Grade'),
                                            ]),
                                    ]),
                            ]),
                        Tab::make('Experience')
                            ->schema([
                                RepeatableEntry::make('employment_details')
                                    ->label('Employment Details')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextEntry::make('organisation'),
                                                TextEntry::make('designation'),
                                                TextEntry::make('from_date')->date(),
                                                TextEntry::make('to_date')->date(),
                                                TextEntry::make('annual_ctc')->label('Annual CTC'),
                                            ]),
                                    ]),
                            ]),
                        Tab::make('Family & Refs')
                            ->schema([
                                RepeatableEntry::make('family_details')
                                    ->label('Family Details')
                                    ->schema([
                                        Grid::make(4)
                                            ->schema([
                                                TextEntry::make('name'),
                                                TextEntry::make('relation'),
                                                TextEntry::make('occupation'),
                                                TextEntry::make('contact_no'),
                                            ]),
                                    ]),
                                RepeatableEntry::make('professional_references')
                                    ->label('Professional References')
                                    ->schema([
                                        Grid::make(4)
                                            ->schema([
                                                TextEntry::make('name'),
                                                TextEntry::make('organisation'),
                                                TextEntry::make('designation'),
                                                TextEntry::make('contact_no'),
                                            ]),
                                    ]),
                            ]),
                        Tab::make('Declaration')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('declaration_date')
                                            ->date(),
                                        TextEntry::make('declaration_place'),
                                        ImageEntry::make('signature'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
