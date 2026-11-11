<?php

namespace Database\Seeders;

use App\Models\AboutProfile;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        $profile = AboutProfile::firstOrCreate(
            [],
            [
                'name' => 'FARDIN',
                'full_name' => 'Fardin Muhammad Azis',
                'role' => 'INFORMATICS ENGINEERING STUDENT',
                'profile_label' => 'DEVELOPER PROFILE',
                'image_path' => 'images/pik.jpg',
                'quote' => 'WITH GREAT CODE COMES GREAT RESPONSIBILITY.',
                'est_year' => 2026,
                'universe_code' => 'EARTH - 001',
            ]
        );

        $descriptions = [
            "Hi, I'm Fardin Muhammad Azis — an Informatics Engineering student with a growing passion for web development and technology.",

            "I'm an Informatics Engineering student who enjoys building web applications and turning ideas into functional products.",

            "I believe the best way to learn is by building. I enjoy working on real projects, experimenting with new technologies, and turning challenges into opportunities to improve as a developer.",
        ];

        foreach ($descriptions as $index => $description) {
            $profile->descriptions()->firstOrCreate(
                ['sort_order' => $index + 1],
                ['content' => $description]
            );
        }

        $focusAreas = [
            [
                'title' => 'DESIGN & INTERFACE',
                'description' => 'Building clean and responsive user interfaces.',
            ],
            [
                'title' => 'WEB DEVELOPMENT',
                'description' => 'Turning concepts into real web applications.',
            ],
            [
                'title' => 'CONTINUOUS LEARNING',
                'description' => 'Experimenting, improving, and learning every day.',
            ],
        ];

        foreach ($focusAreas as $index => $area) {
            $profile->focusAreas()->firstOrCreate(
                ['sort_order' => $index + 1],
                $area
            );
        }
    }
}
