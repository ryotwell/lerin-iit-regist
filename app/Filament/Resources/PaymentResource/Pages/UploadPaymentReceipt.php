<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use App\Models\Payment;
use Filament\Forms;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class UploadPaymentReceipt extends EditRecord
{
    protected static string $resource = PaymentResource::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Upload Bukti Pembayaran';
    
    protected static ?string $navigationLabel = 'Upload Bukti Pembayaran';
    
    protected static ?string $navigationGroup = 'Pembayaran';

    public $receipt_image;

    public static function canAccess(array $parameters = []): bool
    {
        return $parameters['record']->id === auth()->user()->id;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            \Filament\Forms\Components\FileUpload::make('receipt_image')
                ->label('Bukti Transfer (max 4MB)')
                ->directory('uploads/payments')
                ->image()
                ->required()
                ->maxSize(4096),
            Forms\Components\Select::make('payment_method')
                    ->options([
                            'bank_transfer' => 'Bank Transfer',
                            'cash' => 'Cash',
                    ])
                    ->label('Metode Pembayaran')
                    ->required(),

            \Filament\Forms\Components\View::make('components.click-button-save-after-uploaded'),
        ]);
    }
}
