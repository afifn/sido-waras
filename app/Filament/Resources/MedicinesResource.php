<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicinesResource\Pages;
use App\Models\Medicines;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicinesResource extends Resource
{
    protected static ?string $model = Medicines::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationGroup = 'Medicine Management';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Medicine Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\RichEditor::make('description')
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->prefix('Rp')
                            ->numeric()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('stock_quantity')
                            ->label('quantity')
                            ->numeric()
                            ->suffix('stock')
                            ->required(),
                        Select::make('categories')
                            ->multiple()
                            ->relationship('categories', 'name')
                            ->preload()
                            ->required(),
                    ])
                    ->description('Enter the details of the medicine'),
                SpatieMediaLibraryFileUpload::make('medicine')
                    ->collection('medicines')
                    ->multiple()
                    ->responsiveImages()
                    ->panelLayout('grid')
                    ->imageEditor()
                    ->openable()
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('price')
                    ->money('IDR'),
                TextColumn::make('stock_quantity')
                    ->label('Stock'),
                TextColumn::make('categories.name')
                    ->label('Categories')
                    ->bulleted(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicines::route('/'),
            'create' => Pages\CreateMedicines::route('/create'),
            'edit' => Pages\EditMedicines::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
