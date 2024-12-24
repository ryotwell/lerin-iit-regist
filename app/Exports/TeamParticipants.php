<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class TeamParticipants implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::whereHas('payment')->get();

        $names = $users->flatMap(function($user) {
            return [
                $user->responsible_person_name,
                $user->participant_one_name,
                $user->participant_two_name,
            ];
        });

        return $names->filter(function($name) {
            return !empty($name);
        })->map(function($name) {
            return ['name' => $name];
        })->values();
    }
}
