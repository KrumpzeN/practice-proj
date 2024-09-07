<?php

namespace App\Filament\Resources\BikeBrandResource\Pages;

use App\Filament\Resources\BikeBrandResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBikeBrands extends ListRecords
{
    protected static string $resource = BikeBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
