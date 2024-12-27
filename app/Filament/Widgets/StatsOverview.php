<?php

namespace App\Filament\Widgets;

use App\Models\Medicines;
use App\Models\Orders;
use App\Models\Payments;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    protected ?string $heading = 'Analytics';
    protected static ?int $sort = 0;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Order', Orders::count())
                // ->description('32k increase')
                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                // ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Revenue', Payments::sum('amount'))
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Medicine', Medicines::count())
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
