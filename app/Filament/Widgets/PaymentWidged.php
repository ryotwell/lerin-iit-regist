<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class PaymentWidged extends Widget
{
    protected static string $view = 'filament.widgets.payment-widged';

    protected static ?int $sort = 2;

    protected static bool $isLazy = false;

    protected int|string|array $columnSpan = 'full';
}
