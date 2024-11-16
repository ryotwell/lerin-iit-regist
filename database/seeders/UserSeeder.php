<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'King Slebew',
            'role' => 'admin',
            'email' => 'ryotwell@icloud.com',
            'password' => bcrypt('123'),

            // team information
            'agency' => 'Universitas Hamzanwadi',
            'robot_category' => 'sumo',
            'responsible_person_name' => 'Akbar',
            'whatsapp_number' => '085737074723',

            'participant_one_name' => 'Zulzario Zaeri',
            'participant_one_nim_or_nis' => '220602030',
    
            'participant_two_name' => 'Muhammad Dia\'k Udin Maulidi',
            'participant_two_nim_or_nis' => null,
        ]);

        Payment::create([
            'user_id' => $user->id,
        ]);

        // User::factory(100)->create()->each(function ($user) {
        //     Payment::create([
        //         'user_id' => $user->id,
        //         'payment_method' => Arr::random(['bank_transfer', 'cash']),
        //         'status' => Arr::random(['pending', 'approved', 'rejected']),
        //     ]);
        // });
    }
}
