<?php

namespace App\Filament\Widgets;

use App\Exports\UsersExport;
use Filament\Widgets\Widget;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataWidget extends Widget
{
    protected static string $view = 'filament.widgets.export-data-widget';

    public function export()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Akses tidak diizinkan.');
        }

        return Excel::download(new UsersExport, 'data.xlsx');
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
