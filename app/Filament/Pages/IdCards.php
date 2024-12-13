<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class IdCards extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.id-cards';

    public static function getNavigationLabel(): string
    {
        return 'ID Cards';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user() && auth()->user()->hasRole('admin');
    }
    
    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user() && auth()->user()->hasRole('admin');
    }
}
