<?php

use App\Exports\TeamParticipants;
use App\Filament\Widgets\ExportDataWidget;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/api/teams/participants', function() {
    $files = [
        Excel::download(new TeamParticipants('avoider'), 'avoider-participants.xlsx'),
        Excel::download(new TeamParticipants('sumo'), 'sumo-participants.xlsx')
    ];
    
    $zip = new ZipArchive();
    $zipFileName = 'participants.zip';
    $zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);
    
    foreach ($files as $file) {
        $zip->addFromString(basename($file->getFile()), file_get_contents($file->getFile()));
    }
    
    $zip->close();
    
    return response()->download($zipFileName)->deleteFileAfterSend();
});