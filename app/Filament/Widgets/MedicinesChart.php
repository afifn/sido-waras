<?php

namespace App\Filament\Widgets;

use App\Models\Medicines;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class MedicinesChart extends ApexChartWidget
{
    protected static ?int $sort = 1;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'medicinesChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'MedicinesChart';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $data = Trend::model(Medicines::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth()
            )
            ->dateAlias('weight')
            ->perDay()
            ->count();
        // dd($data);
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Medicines Chart',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'xaxis' => [
                'categories' => $data->map(fn(TrendValue $value) => $value->date),
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
            'stroke' => [
                'curve' => 'smooth',
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
        ];
    }
}
