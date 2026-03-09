<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Collette Health',
                'excerpt' => 'A 24/7/365 patient monitoring web application used by over 185 hospitals',
                'description' => 'I led the development of this application which uses over 30 millions minutes of video per month with an uptime of 99.999%. I was responsible for the overall architecture and design of the application, as well as the implementation of new features and the maintenance of existing features. I also worked closely with the product team to ensure that the application met the needs of our users, winning Best in KLAS for Virtual Nursing & Patient Sitting (2025, 2026).',
                'image' => null,
                'url' => 'https://www.collettehealth.com',
                'is_featured' => true,
                'sort_order' => 3,
                'published_at' => '2020-06-30 12:00:00',
                'technologies' => ['Laravel', 'Vue', 'MySQL', 'Git', 'CI/CD', 'PHPUnit', 'Docker', 'GCP', 'Tailwind CSS', 'Typescript'],
            ],
            [
                'title' => 'QuickBooks Reconciliation',
                'excerpt' => 'QuickBooks integrated web application for media agencies to allow reconcilation between client budgets and vendor bills',
                'description' => null,
                'image' => null,
                'url' => null,
                'is_featured' => false,
                'sort_order' => 4,
                'published_at' => '2025-03-09 12:00:00',
                'technologies' => ['Laravel', 'Vue', 'MySQL', 'Git', 'CI/CD', 'PHPUnit', 'Docker', 'GCP', 'Tailwind CSS', 'Typescript'],
            ],
            [
                'title' => 'Portfolio API + SDK',
                'excerpt' => 'Designed an API for my personal portfolio website',
                'description' => 'Created an API with Laravel, following the JSON:API spec. I also created a TypeScript (Node.js) SDK for the API, which is used in my portfolio website.',
                'image' => null,
                'url' => 'https://api.iamseth.com',
                'is_featured' => true,
                'sort_order' => 1,
                'published_at' => '2026-03-08 12:00:00',
                'technologies' => ['Laravel', 'SQLite', 'Git', 'CI/CD', 'Pest', 'Docker', 'GCP', 'Node.js', 'Typescript'],
            ],
            [
                'title' => 'Portfolio Website',
                'excerpt' => 'Front end for my personal portfolio website)',
                'description' => 'Built the front end of this website using Next.js and React. The website consumes the Portfolio API via the SDK that I built.',
                'image' => null,
                'url' => 'https://iamseth.com',
                'is_featured' => false,
                'sort_order' => 2,
                'published_at' => '2026-03-09 12:00:00',
                'technologies' => ['Next.js', 'React', 'Typescript', 'Tailwind CSS', 'Git'],
            ],
            [
                'title' => 'Faculty / Staff Directory',
                'excerpt' => 'Directory of faculty and staff for Purdue Veterinary Medicine',
                'description' => null,
                'image' => null,
                'url' => 'https://vet.purdue.edu/directory/',
                'is_featured' => false,
                'sort_order' => 5,
                'published_at' => '2015-08-01 12:00:00',
                'technologies' => ['PHP', 'MySQL', 'Git', 'Bootstrap'],
            ],
            [
                'title' => 'Fish4Health',
                'excerpt' => 'Developed website and iOS application for a grant project at Purdue University',
                'description' => null,
                'image' => null,
                'url' => 'https://www.purdue.edu/newsroom/archive/releases/2014/Q3/iphone-app-guides-pregnant,-nursing-women-on-eating-fish-safely.html',
                'is_featured' => false,
                'sort_order' => 6,
                'published_at' => '2014-08-06 12:00:00',
                'technologies' => ['Objective-C', 'SQLite', 'Git', 'Bootstrap'],
            ],
            [
                'title' => 'Interactive Building Directory',
                'excerpt' => 'Created a (touchscreen) interactive directory for a building on Purdue University\'s campus',
                'description' => null,
                'image' => null,
                'url' => null,
                'is_featured' => false,
                'sort_order' => 7,
                'published_at' => '2015-08-01 12:00:00',
                'technologies' => ['PHP', 'MySQL', 'Git', 'Bootstrap'],
            ],
        ];

        foreach ($projects as $data) {
            $technologies = $data['technologies'] ?? [];

            $project = Project::updateOrCreate(
                ['title' => $data['title']],
                collect($data)->except('technologies')->all(),
            );

            $technologyIds = Technology::whereIn('name', $technologies)
                ->pluck('id');

            $project->technologies()->sync($technologyIds);
        }
    }
}
