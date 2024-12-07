<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditPayment extends EditRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
            Action::make('view_receipt')
                ->label('View Receipt')
                ->url(fn ($record) => asset('storage/' . $record?->receipt_image))
                ->visible(fn ($record) => $record?->receipt_image)
                ->icon('heroicon-o-photo')
                ->openUrlInNewTab(),
        ];
    }

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user() && auth()->user()->hasRole('admin');
    }
}
