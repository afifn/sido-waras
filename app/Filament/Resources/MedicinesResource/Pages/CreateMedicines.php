<?php

namespace App\Filament\Resources\MedicinesResource\Pages;

use App\Filament\Resources\MedicinesResource;
use App\Models\MedicineImages;
use App\Models\Medicines;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicines extends CreateRecord
{
    protected static string $resource = MedicinesResource::class;
}
