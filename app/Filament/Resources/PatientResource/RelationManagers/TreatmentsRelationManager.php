<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'treatments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full')
                    ->label('Treatment Description'),
                Textarea::make('notes')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpan('full')
                    ->label('Notes'),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('R$')
                    ->maxValue('999999.99')
                    ->label('Price'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->label('Treatment Description'),
                TextColumn::make('price')
                    ->money('BRL')
                    ->sortable()
                    ->label('Price'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created At'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
