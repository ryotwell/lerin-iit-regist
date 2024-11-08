<?php

use App\Filament\Widgets\ExportDataWidget;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/filament/widgets/export-data-widget/export', [ExportDataWidget::class, 'export'])
    ->name('filament.widgets.export-data-widget.export')
    ->middleware(['auth']);