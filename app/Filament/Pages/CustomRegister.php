<?php

namespace App\Filament\Pages\Auth;

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
                View::make('components.sign-up-creds'),
                $this->getNameFormComponent()->label('Nama Tim'),
                TextInput::make('agency')
                    ->required()
                    ->label('Asal Instansi')
                    ->placeholder('Contoh: Universitas Hamzanwadi/SMKN 1 Selong'),
                Select::make('robot_category')
                ->required()
                ->label('Kategori Robot')
                ->options([
                        'Robot Sumo' => 'Robot Sumo',
                        'Obstacle Avoidance' => 'Obstacle Avoidance',
                ]),
                $this->getEmailFormComponent()
                    ->label('Alamat Email'),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent()
                    ->label('Konfirmasi Password'),

                View::make('components.divider'),
                View::make('components.sign-up-team'),

                Fieldset::make('Anggota Tim 1 (ketua)')
                    ->schema([
                        TextInput::make('participant_one_name')
                            ->required()
                            ->label('Nama'),
                        TextInput::make('participant_one_nim_or_nis')
                            ->required()
                            ->label('NIM/NIS'),
                ]),
                Fieldset::make('Anggota Tim 2')
                    ->schema([
                        TextInput::make('participant_two_name')
                            ->required()
                            ->label('Nama'),
                        TextInput::make('participant_two_nim_or_nis')
                            ->required()
                            ->label('NIM/NIS'),
                ]),
                Fieldset::make('Anggota Tim 3')
                    ->schema([
                        TextInput::make('participant_three_name')
                            ->nullable()
                            ->label('Nama'),
                        TextInput::make('participant_three_nim_or_nis')
                            ->nullable()
                            ->label('NIM/NIS'),
                ]),
                Fieldset::make('Anggota Tim 4')
                    ->schema([
                        TextInput::make('participant_four_name')
                            ->nullable()
                            ->label('Nama'),
                        TextInput::make('participant_four_nim_or_nis')
                            ->nullable()
                            ->label('NIM/NIS'),
                ]),
                Fieldset::make('Anggota Tim 5')
                    ->schema([
                        TextInput::make('participant_five_name')
                            ->nullable()
                            ->label('Nama'),
                        TextInput::make('participant_five_nim_or_nis')
                            ->nullable()
                            ->label('NIM/NIS'),
                ]),
            ]);
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
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