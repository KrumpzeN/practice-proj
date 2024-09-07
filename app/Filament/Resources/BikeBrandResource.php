<?php
namespace App\Filament\Resources;

use App\Filament\Resources\BikeBrandResource\Pages;
use App\Models\BikeBrand;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;

class BikeBrandResource extends Resource
{
    protected static ?string $model = BikeBrand::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('name'),
                Textarea::make('countryName'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('countryName'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
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
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                ->successNotification(null)
                ->using(function (Collection $records) {
                    
                    $failedCount = 0;
                    $deletedCount = 0;
                
                    foreach ($records as $record) {
                        if ($record->bikes()->exists()) {
                            $failedCount++;
                        } else {
                            $record->delete();
                            $deletedCount++;
                        }
                    }
                
                    if ($deletedCount > 0 || $failedCount > 0) {
                        if ($failedCount > 0 && $deletedCount > 0) {
                            Notification::make()
                                ->title('Delete Results')
                                ->body("Successfully deleted {$deletedCount} bike brand(s), but failed to delete {$failedCount} because they are assigned to bikes.")
                                ->danger()
                                ->send();
                        } elseif ($failedCount > 0) {
                            Notification::make()
                                ->title('Delete Failed')
                                ->body("Failed to delete {$failedCount} bike brand(s) because they are assigned to bikes.")
                                ->danger()
                                ->send();
                        } elseif ($deletedCount > 0) {
                            Notification::make()
                                ->title('Delete Success')
                                ->body("Successfully deleted {$deletedCount} bike brand(s).")
                                ->success()
                                ->send();
                        }
                    }
                }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBikeBrands::route('/'),
            'create' => Pages\CreateBikeBrand::route('/create'),
            'edit' => Pages\EditBikeBrand::route('/{record}/edit'),
        ];
    }
}
