<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            // languages/frameworks
            'Laravel',
            'Vue',
            'PHP',
            'Node.js',
            'JavaScript',
            'Typescript',
            'Objective-C',
            'React',
            'Next.js',

            // css
            'Bootstrap',
            'Tailwind CSS',

            // databases
            'MySQL',
            'SQLite',

            // other
            'Git',
            'Docker',
            'GCP',
            'CI/CD',
            'PHPUnit',
            'Pest',

        ];

        foreach ($technologies as $name) {
            Technology::firstOrCreate(['name' => $name]);
        }
    }
}
