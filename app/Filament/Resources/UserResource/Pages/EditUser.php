<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_receipt')
                ->label('View Receipt')
                ->url(fn ($record) => asset('storage/' . $record->payment?->receipt_image))
                ->visible(fn ($record) => $record->payment?->receipt_image)
                ->icon('heroicon-o-photo')
                ->openUrlInNewTab(),
            Action::make('edit_payment')
                ->label('Edit Payment')
                ->url(fn ($record) => "/panel/payments/{$record->payment->id}/edit")
                ->visible(fn ($record) => $record->payment !== null)
                ->icon('heroicon-o-currency-dollar'),
            // Actions\DeleteAction::make(),
        ];
    }
}
