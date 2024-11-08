<?php

namespace App\Filament\Pages;

use App\Events\UserRegistered;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Events\Auth\Registered;

class CustomRegister extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent()->label('Nama Tim'),
                TextInput::make('agency')
                    ->required()
                    ->label('Asal Instansi')
                    ->placeholder('Contoh: Universitas Hamzanwadi/SMKN 1 Selong'),
                Select::make('robot_category')
                    ->required()
                    ->label('Kategori Robot')
                    ->options([
                            'sumo' => 'Sumo Game',
                            'avoider' => 'Avoider (obstacle)',
                    ])
                    ->placeholder('Pilih salah satu kategori robot')
                    ->default(request()->query('robot_category')),

                View::make('components.divider'),
                View::make('components.sign-up-creds'),

                $this->getEmailFormComponent()
                    ->label('Alamat Email'),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent()
                    ->label('Konfirmasi Password'),

                View::make('components.divider'),
                View::make('components.sign-up-team'),

                Fieldset::make('Anggota Tim 1 (Penanggung Jawab Tim)')
                    ->schema([
                        TextInput::make('participant_one_name')
                            ->required()
                            ->label('Nama'),
                        TextInput::make('participant_one_nim_or_nis')
                            ->required()
                            ->numeric()
                            ->minLength(4)
                            ->maxLength(15)
                            ->label('NIM / NIS'),
                ]),
                Fieldset::make('Anggota Tim 2')
                    ->schema([
                        TextInput::make('participant_two_name')
                            ->required()
                            ->label('Nama'),
                        TextInput::make('participant_two_nim_or_nis')
                            ->required()
                            ->numeric()
                            ->minLength(4)
                            ->maxLength(15)
                            ->label('NIM / NIS'),
                ]),
                Fieldset::make('Anggota Tim 3')
                    ->schema([
                        TextInput::make('participant_three_name')
                            ->required()
                            ->label('Nama'),
                        TextInput::make('participant_three_nim_or_nis')
                            ->required()
                            ->numeric()
                            ->minLength(4)
                            ->maxLength(15)
                            ->label('NIM / NIS'),
                ]),

                View::make('components.admin-contact'),
            ]);
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(20);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $user = $this->wrapInDatabaseTransaction(function () {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeRegister($data);

            $this->callHook('beforeRegister');

            $user = $this->handleRegistration($data);

            $this->form->model($user)->saveRelationships();

            $this->callHook('afterRegister');

            return $user;
        });

        event(new Registered($user));
        event(new UserRegistered($user));

        $this->sendEmailVerificationNotification($user);

        Filament::auth()->login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }
}