<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user() && auth()->user()->hasRole('admin');
    }
}
