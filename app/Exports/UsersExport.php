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
            'Nama Tim',
            'Instansi',
            'Kategori Robot',
            'Status Pembayaran',
            'Metode Pembayaran',

            'Penanggung Jawab',
            'Whatsapp',

            'Nama Peserta 1',
            'Nama Peserta 2',

            'NIM/NIS Peserta 1',
            'NIM/NIS Peserta 2',

            'Email',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name ?? '-',
            $user->agency ?? '-',
            getCategoryName($user->robot_category),
            getPaymentStatus($user->payment->status),
            getPaymentMethod($user->payment->payment_method),

            $user->responsible_person_name ?? '-',
            $user->whatsapp_number ?? '-',

            $user->participant_one_name ?? '-',
            $user->participant_two_name ?? '-',

            $user->participant_one_nim_or_nis ?? '-',
            $user->participant_two_nim_or_nis ?? '-',

            $user->email,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 25,
            'D' => 25,
            'E' => 25,
            'F' => 25,
            'G' => 25,
            'H' => 25,
            'I' => 25,
            'J' => 25,
            'K' => 25,
            'L' => 25,
            'M' => 25,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:M1')->getFont()->setBold(true);
        $sheet->getStyle('A1:M1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A:M')->getAlignment()->setHorizontal('center');
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
