<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Asal Instansi',
            'Kategori Robot',
            
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
            $user->robot_category,

            $user->participant_one_name,
            $user->participant_one_nim_or_nis,
            $user->participant_two_name,
            $user->participant_two_nim_or_nis,
            $user->participant_three_name,
            $user->participant_three_nim_or_nis,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
