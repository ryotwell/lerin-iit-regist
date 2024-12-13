<?php

use App\Filament\Widgets\ExportDataWidget;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/filament/widgets/export-data-widget/export', [ExportDataWidget::class, 'export'])
    ->name('filament.widgets.export-data-widget.export')
    ->middleware(['auth']);

// api
Route::get('/api/teams', function() {

    if(! auth()->user()->hasRole('admin') ) return abort(403);

    $users = User::whereHas('payment', function ($query) {
        $query->where('status', 'approved');
    })->get();

    return $users;
})->middleware('auth');