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
            'name' => 'Seth Bossingham',
            'headline' => "I'm a full-stack software engineer who loves the craft of building things well and shipping fast.",
            'bio' => "I'm a full-stack software engineer who loves the craft of building things well and shipping fast. I care deeply about code quality, system design, and efficiency at every level — from developer workflows and tooling to application performance and end-user experience. Laravel is my home base, and I thrive when working on complex problems that demand both technical precision and thoughtful architecture.",
            'avatar' => null,
            'email' => 'github@iamseth.com',
        ]);
    }
}
