<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Ryo Otwell',
            'role' => 'admin',
            'email' => 'ryotwell@icloud.com',
            'password' => bcrypt('123'),

            // team information
            'agency' => 'Universitas Hamzanwadi',
            'robot_category' => 'sumo',
        ]);

        Payment::create([
            'user_id' => $user->id,
            'payment_method' => 'bank_transfer',
        ]);
    }
}
