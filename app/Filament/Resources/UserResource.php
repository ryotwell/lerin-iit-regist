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
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Forms\Components\TextInput::make('role')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\Fieldset::make('Penanggung Jawab')
                    ->schema([
                        Forms\Components\TextInput::make('responsible_person_name')
                            ->required()
                            ->label('Nama'),
                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('Nomor Whatsapp')
                            ->numeric(),
                ]),
                Forms\Components\Fieldset::make('Anggota Tim 1')
                    ->schema([
                        Forms\Components\TextInput::make('participant_one_name')
                            ->required()
                            ->label('Nama'),
                        Forms\Components\TextInput::make('participant_one_nim_or_nis')
                            ->required()
                            ->label('NIM / NIS'),
                ]),
                Forms\Components\Fieldset::make('Anggota Tim 2')
                    ->schema([
                        Forms\Components\TextInput::make('participant_two_name')
                            ->required()
                            ->label('Nama'),
                        Forms\Components\TextInput::make('participant_two_nim_or_nis')
                            ->required()
                            ->label('NIM / NIS'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Tim'),
                Tables\Columns\TextColumn::make('agency')
                    ->label('Instansi'),
                Tables\Columns\TextColumn::make('robot_category')
                    ->label('Kategori Robot')
                    ->getStateUsing(fn (User $user) => $user->robot_category === 'sumo' ? 'Sumo Game' : 'Avoider (obstacle)'),
                Tables\Columns\TextColumn::make('responsible_person_name')
                    ->searchable()
                    ->label('Ketua/Penanggung Jawab Tim'),
                Tables\Columns\TextColumn::make('whatsapp_number')
                    ->searchable()
                    ->label('Whatsapp'),
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
                Tables\Filters\SelectFilter::make('robot_category')
                    ->options([
                        'sumo' => 'Sumo Game',
                        'avoider' => 'Avoider (Obstacle)',
                    ])
                    ->label('Kategori Robot')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
