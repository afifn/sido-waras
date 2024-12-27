<?php

namespace App\Filament\Resources\MedicinesResource\Pages;

use App\Filament\Resources\MedicinesResource;
use App\Models\MedicineImages;
use App\Models\Medicines;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicines extends EditRecord
{
    protected static string $resource = MedicinesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
