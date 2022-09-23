<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
    use RefreshDatabase;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [];

        for ($i = 1; $i <= 5; $i++) {
            $clients[] = [
                'email' => fake()->unique()->safeEmail(),
                'join_date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Client::insert($clients);
    }
}
