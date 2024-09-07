<?php

namespace App\Filament\Resources\BikeBrandResource\Pages;

use App\Filament\Resources\BikeBrandResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Models\BikeBrand;
use Filament\Notifications\Notification;

class EditBikeBrand extends EditRecord
{
    protected static string $resource = BikeBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->using(function (BikeBrand $record) {
                if ($record->bikes()->exists()) {
                    Notification::make()
                        ->title('Delete Failed')
                        ->body('The bike brand cannot be deleted because it is assigned to a bike.')
                        ->danger()
                        ->send();
                } else {
                    $record->delete();
                    Notification::make()
                        ->title('Delete Success')
                        ->body('The bike brand has been deleted.')
                        ->success()
                        ->send();
                }
            }),
        ];
    }
}
