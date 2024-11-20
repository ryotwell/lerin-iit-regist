<?php

namespace App\Filament\Widgets;

use App\Exports\UsersExport;
use Filament\Widgets\Widget;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataWidget extends Widget
{
    protected static string $view = 'filament.widgets.export-data-widget';

    protected static ?int $sort = 99;

    public function export()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Akses tidak diizinkan.');
        }

        if (request()->has('robot_category')) {
            $robot_category = request()->robot_category;
        } else {
            $robot_category = null;
        }

        return Excel::download(new UsersExport($robot_category), 'data.xlsx');
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
