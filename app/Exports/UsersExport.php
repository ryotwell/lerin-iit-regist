<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $robot_category;

    public function __construct($robot_category = null)
    {
        $this->robot_category = $robot_category;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tim',
            'Email Tim',
            'Instansi',
            'Kategori Robot',
            'Status Pembayaran',

            'Nama Peserta 1',
            'NIM/NIS Peserta 1',
            'Nama Peserta 2',
            'NIM/NIS Peserta 2',
            'Nama Peserta 3',
            'NIM/NIS Peserta 3',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->agency,
            ($user->robot_category == 'avoider') ? 'Avoider (Obstacle)' : 'Sumo Game',
            ($user->payment->status == 'approved') ? 'Lunas' : 'Belum Lunas',

            $user->participant_one_name,
            $user->participant_one_nim_or_nis,
            $user->participant_two_name,
            $user->participant_two_nim_or_nis,
            $user->participant_three_name,
            $user->participant_three_nim_or_nis,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 25,
            'D' => 25,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20, 
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:L1')->getFont()->setBold(true);
        $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A:K')->getAlignment()->setHorizontal('center');
        return [];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = User::query();
        if ($this->robot_category) {
            $query->where('robot_category', $this->robot_category);
        }

        return $query->with('payment')->get();
    }
}
