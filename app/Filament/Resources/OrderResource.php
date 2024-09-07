<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Bike;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Widgets\OrderStatistics;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Administration';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('email')
                ->required()
                ->email(),
            Forms\Components\Select::make('bike_id')
                ->relationship('bike', 'name')
                ->required(),
            Forms\Components\TextInput::make('quantity')
                ->required()
                ->integer(),
            Forms\Components\TextInput::make('total_amount')
                ->required()
                ->numeric(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('bike')
            ->label('Bike')
            ->getStateUsing(function ($record) {
                return $record->bike->id . ': ' . $record->bike->article;
            }),
            Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantity')
                    ->formatStateUsing(function ($state) {
                        return $state > 5 ? "<span style='color: red;'>$state</span>" : "<span style='color: green;'>$state</span>";
                    })
                    ->html(),
            Tables\Columns\TextColumn::make('total_amount'),
            Tables\Columns\TextColumn::make('created_at'),
            Tables\Columns\TextColumn::make('updated_at'),
            BooleanColumn::make('notified')->label('Notified'),
        ])
        ->filters([
            SelectFilter::make('bike_availability')
                    ->label('Bike Availability')
                    ->options([ 
                        1 => 'Available',
                        0 => 'Unavailable',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (isset($data['value']) && $data['value'] !== '') {
                            $query->whereHas('bike', function (Builder $subQuery) use ($data) {
                                $subQuery->where('availability', $data['value']);
                            });
                        }
                    }),
            
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            BulkAction::make('markDelivered')
                ->label('Mark as Delivered')
                ->action(function (array $records) {
                    Order::whereIn('id', $records)->update(['delivered' => true]);
                }),
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getWidgets(): array
    {
        return [
            OrderStatistics::class,
        ];
    }

    public static function getRelations(): array
    {
        return [
            // Define any relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
