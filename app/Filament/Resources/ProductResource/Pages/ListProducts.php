<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Actions;
use App\Models\Product;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProductResource;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('inviteStaffUser')
                ->modalHidden(function () {
                    Notification::make()
                        ->title('Modal hidden')
                        ->success()
                        ->send();

                    return false;
                })
                ->modalHeading(function () {
                    Notification::make()
                        ->title('Modal heading')
                        ->warning()
                        ->send();

                    return 'Modal heading';
                })
                ->modalDescription(function () {
                    Notification::make()
                        ->title('Modal description')
                        ->danger()
                        ->send();

                    return 'Modal description';
                })
                ->modalSubmitActionLabel('Modal submit')
                ->form([
                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
                ])
        ];
    }
}
