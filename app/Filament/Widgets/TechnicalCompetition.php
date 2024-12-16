<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TechnicalCompetition extends Widget
{
    protected static string $view = 'filament.widgets.technical-competition';

    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()->payment->status === 'approved' || isHamzanwadiStudent(auth()->user()->agency);
    }
}
