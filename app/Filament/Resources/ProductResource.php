<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use App\Filament\Exports\ProductExporter;
use App\Filament\Imports\ProductImporter;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use Intervention\Validation\Rules\Domainname;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('website')
                    ->rules([new Domainname()])
                    ->required(),                    

                Select::make('type')
                    ->options([
                        'physical' => 'Physical',
                        'digital' => 'Digital',
                    ])
                    ->native(false)
                    ->required(),

                Actions::make([
                    Action::make('extraModalFooterActionsTest')
                        ->action(function () {
                            //
                        })
                        ->modal()
                        ->modalHeading('Test')
                        ->modalSubmitActionLabel('Submit')
                        ->extraModalFooterActions([
                            \Filament\Actions\Action::make('extraAction')
                                ->requiresConfirmation()
                                ->action(function () {
                                    Notification::make()
                                        ->title('Extra action fired')
                                        ->info()
                                        ->send();

                                    dd('test');
                                }),
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(ProductImporter::class),


                ExportAction::make()
                    ->exporter(ProductExporter::class),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
