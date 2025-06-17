<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Filament\Resources\PatientResource\RelationManagers\TreatmentsRelationManager;
use App\Models\Patient;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class PatientResource extends Resource
{
    protected static ?array $patientTypes = [
        'cat' => 'Cat',
        'dog' => 'Dog',
        'rabit' => 'Rabbit',
        'hamster' => 'Hamster',
        'bird' => 'Bird',
        'fish' => 'Fish',
        'reptile' => 'Reptile',
        'rodent' => 'Rodent',
        'ferret' => 'Ferret',
        'other' => 'Other',
    ];

    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Patient Name'),
                Select::make('type')
                    ->options(self::$patientTypes)
                    ->required()
                    ->label('Type of Animal'),
                DatePicker::make('date_of_birth')
                    ->required()
                    ->maxDate(Date::now())
                    ->label('Date of Birth'),
                Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->required()
                    ->label('Owner')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Owner Name'),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255)
                            ->label('Email address'),
                        TextInput::make('phone')
                            ->required()
                            ->tel()
                            ->maxLength(20)
                            ->label('Phone number'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Patient Name'),
                TextColumn::make('type')
                    ->sortable()
                    ->label('Type of Animal'),
                TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable()
                    ->label('Date of Birth'),
                TextColumn::make('owner.name')
                    ->searchable()
                    ->label('Owner Name'),
                TextColumn::make('owner.email')
                    ->searchable()
                    ->label('Owner Email'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(self::$patientTypes)
                    ->label('Animal Type'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TreatmentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
