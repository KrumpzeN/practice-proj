<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BikeResource\Pages;
use App\Filament\Resources\BikeResource\RelationManagers;
use App\Models\Bike;
use App\Models\BikeBrand;
use App\Models\BikeType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class BikeResource extends Resource
{
    protected static ?string $model = Bike::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $bikeTypes = BikeType::pluck('type', 'id')->toArray();
        $bikeBrand = BikeBrand::pluck('name', 'id')->toArray();


        return $form
            ->schema([
            Textarea::make('name')
            ->required(),
            Textarea::make('price')
            ->required(),
            Radio::make('availability')
                 ->label('Available?')
                 ->boolean()
                 ->required(),
            Textarea::make('article')
                 ->required()
                 ->afterStateUpdated(function ($state, callable $set) {
                     
                    $existingArticle = Bike::where('article', $state)
                         ->exists();
             
                     if ($existingArticle) {
                         Notification::make()
                             ->title('Duplicate Article')
                             ->body('This article already exists. Please choose a different one.')
                             ->danger()
                             ->send();
             
                         
                         $set('article', null);
                     }
                 }),
            Select::make('bike_type_id')
                ->options($bikeTypes)
                ->required(),
            Select::make('bike_brand_id')
                ->options($bikeBrand)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $bikeTypes = BikeType::pluck('type', 'id')->toArray();
        $bikeBrand = BikeBrand::pluck('name', 'id')->toArray();

        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('price'),   
                TextColumn::make('availability')
                ->formatStateUsing(function (string $state, Bike $bike) {
                    return $state === '1' ? 'Yes' : 'No';
                }),   
                TextColumn::make('article'),
                TextColumn::make('bike_brand_id')
                ->formatStateUsing(function (string $state, Bike $bike) {
                    return  "{$bike->bikeBrand->name}";
                })->sortable(),
                TextColumn::make('bike_type_id')
                ->formatStateUsing(function (string $state, Bike $bike) {
                    return  "{$bike->bikeType->type}";
                })->sortable(),
                
                       
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListBikes::route('/'),
            'create' => Pages\CreateBike::route('/create'),
            'edit' => Pages\EditBike::route('/{record}/edit'),
        ];
    }
    
}
