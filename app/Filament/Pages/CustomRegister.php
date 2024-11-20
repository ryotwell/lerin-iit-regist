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
use Filament\Forms\Concerns\InteractsWithForms;

class CustomRegister extends BaseRegister
{
    use InteractsWithForms;

    public string | null $name;

    public string | null $email;

    public string | null $password;

    public string | null $passwordConfirmation;

    public string | null $agency;

    public string | null $robot_category;

    public string | null $whatsapp_number;

    public string | null $responsible_person_name;

    public string | null $responsible_person_nim_or_nis;

    public string | null $participant_one_name;

    public string | null $participant_one_nim_or_nis;

    public string | null $participant_two_name;

    public string | null $participant_two_nim_or_nis;

    public function __construct()
    {
        $this->robot_category = request()->input('robot_category');
    }

    public function form(Form $form): Form
    {
        if ( $this->robot_category === 'avoider' ) {
            $this->responsible_person_nim_or_nis = null;
        }

        return $form->schema([
            View::make('components.sign-up-creds'),

            $this->getEmailFormComponent()
                ->label('Alamat Email'),
            $this->getPasswordFormComponent()
                ->label('Buat Password'),
            $this->getPasswordConfirmationFormComponent()
                ->label('Ketik Ulang Password'),

            View::make('components.divider'),

            $this->getNameFormComponent()
                ->label('Nama Tim')
                ->helperText('Gunakan nama tim yang berbeda dari yang lain untuk memudahkan kami dalam membedakan tim-tim'),
            TextInput::make('agency')
                ->label('Asal Instansi')
                ->helperText('Contoh: Universitas Hamzanwadi/SMKN 1 Selong')
                ->required(),
            Select::make('robot_category')
                ->required()
                ->label('Kategori Robot')
                ->options([
                        'sumo' => 'Sumo Game',
                        'avoider' => 'Avoider (obstacle)',
                ])
                ->placeholder('Pilih salah satu kategori robot')
                ->default($this->robot_category)
                ->reactive()
                ->afterStateUpdated(fn ($state) => $this->robot_category = $state),

            View::make('components.divider')
                ->hidden(fn () => empty($this->robot_category)),
            View::make('components.sign-up-team')
                ->hidden(fn () => empty($this->robot_category)),

            Fieldset::make(getParticipantLabel($this->robot_category))
                ->hidden(fn () => empty($this->robot_category))
                ->schema([
                    TextInput::make('responsible_person_name')
                        ->label('Nama')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('responsible_person_nim_or_nis')
                        ->hidden(fn () => $this->robot_category !== 'sumo')
                        ->label($this->getParticipantIdentifierLabel())
                        ->required()
                        ->numeric()
                        ->columnSpanFull(),
                    TextInput::make('whatsapp_number')
                        ->label('Nomor Whatsapp')
                        ->required()
                        ->numeric()
                        ->columnSpanFull(),
            ]),
            Fieldset::make('Anggota Tim 1')
                ->hidden(fn () => empty($this->robot_category))
                ->schema([
                    TextInput::make('participant_one_name')
                        ->label('Nama')
                        ->columnSpanFull()
                        ->required($this->robot_category === 'avoider'),
                    TextInput::make('participant_one_nim_or_nis')
                        ->label($this->getParticipantIdentifierLabel())
                        ->numeric()
                        ->required($this->robot_category === 'avoider')
                        ->columnSpanFull(),
            ]),
            Fieldset::make('Anggota Tim 2')
                ->hidden(fn () => empty($this->robot_category))
                ->schema([
                    TextInput::make('participant_two_name')
                        ->label('Nama')
                        ->columnSpanFull(),
                    TextInput::make('participant_two_nim_or_nis')
                        ->label($this->getParticipantIdentifierLabel())
                        ->numeric()
                        ->columnSpanFull(),
            ]),
            View::make('components.admin-contact'),
        ]);
    }

    public function getParticipantIdentifierLabel(): string
    {
        return match ($this->robot_category) {
            'sumo' => 'NIM (Nomor Induk Mahasiswa)',
            'avoider' => 'NIS (Nomor Induk Siswa)',
            default => '-',
        };
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