<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class TeamParticipants implements FromCollection
{
    protected $robot_category;

    public function __construct($robot_category = null)
    {
        $this->robot_category = $robot_category;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::query();
        $users = $users->whereHas('payment');

        if ($this->robot_category) {
            $users->where('robot_category', $this->robot_category);
        }

        $users = $users->get();

        $names = $users->flatMap(function($user) {
            return $this->robot_category === 'avoider' ? [
                $user->participant_one_name,
                $user->participant_two_name,
            ] : [
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
