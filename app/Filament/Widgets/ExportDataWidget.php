<?php

namespace App\Filament\Widgets;

use App\Exports\UsersExport;
use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataWidget extends Widget
{
    protected static string $view = 'filament.widgets.export-data-widget';

    protected static ?int $sort = 99;

    protected function getViewData(): array
    {
        $data = User::select('agency', 'robot_category', DB::raw('count(*) as total'))
            ->groupBy('agency', 'robot_category')
            ->get();

        $groupedData = $data->groupBy('agency')->map(function ($agencyData) {
            $result = $agencyData->map(function ($item) {
                return $item->robot_category . ': ' . $item->total;
            })->join(', ');

            return $result;
        });

        return [
            'groupedData' => $groupedData,
        ];
    }

    public function export()
    {
        if (!auth()->user()->hasRole('admin')) {
            return abort(403, 'Akses tidak diizinkan.');
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
