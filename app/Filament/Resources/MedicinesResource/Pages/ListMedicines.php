<?php

namespace App\Filament\Resources\MedicinesResource\Pages;

use App\Filament\Resources\MedicinesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicines extends ListRecords
{
    protected static string $resource = MedicinesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
