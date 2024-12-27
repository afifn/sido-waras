<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersAction;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Dashboard';
    protected static ?int $navigationSort = -2;
    protected static ?string $navigationLabel = 'Dashboard';
    // protected static ?string $navigationBadge = 'Beta';
    // protected static ?string $navigationBadgeColor = 'success';

    protected function getHeaderActions(): array
    {
        return [
            FilterAction::make()
                ->form([
                    DatePicker::make('startDate'),
                    DatePicker::make('endDate'),
                    // ...
                ]),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            // \App\Filament\Widgets\StatsOverview::class,
            // \App\Filament\Widgets\MedicinesChart::class,
        ];
    }

    public function getWidgets(): array
    {
        return Filament::getWidgets();
    }
}
