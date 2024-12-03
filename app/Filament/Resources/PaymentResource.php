<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user() && auth()->user()->hasRole('admin');
    }

    public static function getNavigationLabel(): string
    {
        return 'Daftar Pembayaran';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Tim')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->rules([
                        function ($component) {
                            return Rule::unique('payments', 'user_id')
                                ->ignore($component->getLivewire()->record->id ?? null);
                        },
                    ]),
                Forms\Components\Select::make('status')
                    ->label('Status Pembayaran')
                    ->options(config('lerin.payment_status'))
                    ->default('pending')
                    ->required(),
                // payment method
                Forms\Components\Select::make('payment_method')
                    ->options(config('lerin.payment_methods'))
                    ->label('Metode Pembayaran')
                    ->required(),
                Forms\Components\FileUpload::make('receipt_image')
                    ->directory('uploads/payments')
                    ->label('Bukti Pembayaran')
                    ->image()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Tim')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->getStateUsing(fn ($record) => getPaymentMethod($record->payment_method)),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Pembayaran')
                    ->getStateUsing(fn ($record) => getPaymentStatus($record->status)),
                Tables\Columns\TextColumn::make('receipt_image')
                    ->label('Bukti Pembayaran')
                    ->getStateUsing(fn () => 'Lihat')
                    ->url(fn ($record) => asset('storage/' . $record->receipt_image))
                    ->openUrlInNewTab()
                    ->extraAttributes([
                        'class' => 'text-blue-500 underline hover:text-blue-700'
                    ]),
                Tables\Columns\TextColumn::make('whatsapp_link')
                    ->label('Kirim Pesan WhatsApp')
                    ->getStateUsing(fn () => 'Kirim')
                    ->url(fn ($record) => getWhatsappMessage($record->user->robot_category, $record->user->whatsapp_number))
                    ->openUrlInNewTab()
                    ->extraAttributes([
                        'class' => 'text-green-500 underline hover:text-green-700'
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                ->options(config('lerin.payment_status'))
                ->label('Status Pembayaran'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
            'upload' => Pages\UploadPaymentReceipt::route('/{record}/upload'),
        ];
    }
}
