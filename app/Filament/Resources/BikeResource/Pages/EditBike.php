<?php

namespace App\Filament\Resources\BikeResource\Pages;

use App\Filament\Resources\BikeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;


class EditBike extends EditRecord
{
    protected static string $resource = BikeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
