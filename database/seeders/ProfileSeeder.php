<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::updateOrCreate([], [
            'name' => 'Your Name',
            'headline' => 'Your Headline',
            'bio' => 'Your bio goes here.',
            'avatar' => null,
            'email' => 'you@example.com',
        ]);
    }
}
