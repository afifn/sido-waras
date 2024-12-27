<?php

namespace App\Filament\Resources\PrescriptionsResource\Pages;

use App\Filament\Resources\PrescriptionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrescriptions extends ListRecords
{
    protected static string $resource = PrescriptionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
