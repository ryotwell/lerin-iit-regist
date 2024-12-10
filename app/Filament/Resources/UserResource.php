<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $modelLabel = 'Team';

    // protected static ?string $pluralModelLabel = 'Team';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user() && auth()->user()->hasRole('admin');
    }

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user() && auth()->user()->hasRole('admin');
    }

    public static function getNavigationLabel(): string
    {
        return 'Daftar Tim';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama Tim'),
                Forms\Components\TextInput::make('agency')
                    ->required()
                    ->label('Instansi'),
                Forms\Components\Select::make('robot_category')
                    ->required()
                    ->label('Kategori Robot')
                    ->options([
                        'sumo' => 'Sumo Game',
                        'avoider' => 'Avoider (obstacle)',
                    ])
                    ->placeholder('Pilih salah satu kategori robot')
                    ->default(request()->query('robot_category')),
                Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                    ])
                    ->required()
                ,
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\Fieldset::make('Ketua Tim/Penanggung Jawab')
                    ->schema([
                        Forms\Components\TextInput::make('responsible_person_name')
                            ->label('Nama'),
                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('Nomor Whatsapp')
                            ->numeric(),
                        Forms\Components\TextInput::make('responsible_person_nim_or_nis')
                            ->label('NIM/NIS/NIK'),
                ]),
                Forms\Components\Fieldset::make('Anggota Tim 1')
                    ->schema([
                        Forms\Components\TextInput::make('participant_one_name')
                            ->label('Nama'),
                        Forms\Components\TextInput::make('participant_one_nim_or_nis')
                            ->label('NIM/NIS/NIK'),
                ]),
                Forms\Components\Fieldset::make('Anggota Tim 2')
                    ->schema([
                        Forms\Components\TextInput::make('participant_two_name')
                            ->label('Nama'),
                        Forms\Components\TextInput::make('participant_two_nim_or_nis')
                            ->label('NIM/NIS/NIK'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Tim')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agency')
                    ->label('Instansi')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('robot_category')
                    ->label('Kategori Robot')
                    ->sortable()
                    ->getStateUsing(fn (User $user) => $user->robot_category === 'sumo' ? 'Sumo Game' : 'Avoider (obstacle)')
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('responsible_person_name')
                    ->label('Ketua/Penanggung Jawab Tim')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('whatsapp_number')
                    ->label('Whatsapp')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('payment.payment_method')
                    ->label('Metode Pembayaran')
                    ->getStateUsing(fn ($record) => getPaymentMethod($record->payment->payment_method))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('payment.status')
                    ->label('Status Pembayaran')
                    ->getStateUsing(fn ($record) => getPaymentStatus($record->payment->status))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('payment.receipt_image')
                    ->label('Bukti Pembayaran')
                    ->getStateUsing(fn () => 'Lihat')
                    ->url(fn ($record) => asset('storage/' . $record->payment?->receipt_image))
                    ->openUrlInNewTab()
                    ->extraAttributes([
                        'class' => 'text-blue-500 underline hover:text-blue-700'
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('whatsapp_message')
                    ->label('Buka Percakapan')
                    ->getStateUsing(fn () => 'Whatsapp')
                    ->url(fn ($record) => toWhatsappLink($record->whatsapp_number))
                    ->openUrlInNewTab()
                    ->extraAttributes([
                        'class' => 'text-green-500 underline hover:text-green-700'
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('whatsapp_payment_notification')
                    ->label('Payment Notification')
                    ->getStateUsing(fn () => 'Whatsapp')
                    ->url(fn ($record) => getPaymentNotification($record->robot_category, $record->whatsapp_number))
                    ->openUrlInNewTab()
                    ->extraAttributes([
                        'class' => 'text-green-500 underline hover:text-green-700'
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('whatsapp_payment_success_message')
                    ->label('Payment Berhasil')
                    ->getStateUsing(fn () => 'Whatsapp')
                    ->url(fn ($record) => getPaymentApprovedMessage($record->robot_category, $record->whatsapp_number))
                    ->openUrlInNewTab()
                    ->extraAttributes([
                        'class' => 'text-green-500 underline hover:text-green-700'
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d F, Y')
                    ->sortable()
                    ->label('Dibuat Pada')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d F, Y')
                    ->sortable()
                    ->label('Diperbarui Pada')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('robot_category')
                    ->options([
                        'sumo' => 'Sumo Game',
                        'avoider' => 'Avoider (Obstacle)',
                    ])
                    ->label('Kategori Robot'),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options(config('lerin.payment_status'))
                    ->query(function (Builder $query, array $data) {
                        if (!$data['value']) {
                            return $query;
                        }
                        
                        return $query->whereHas('payment', function ($query) use ($data) {
                            $query->where('status', $data['value']);
                        });
                    }),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Team'),
                Tables\Actions\Action::make('edit_payment')
                    ->label('Payment')
                    ->url(fn ($record) => "/panel/payments/{$record->payment->id}/edit")
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->visible(fn ($record) => $record->payment !== null),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
