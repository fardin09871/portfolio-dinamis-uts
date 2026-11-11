<?php

namespace Database\Seeders;

use App\Models\TechStack;
use Illuminate\Database\Seeder;

class TechStackSeeder extends Seeder
{
    public function run(): void
    {
        $techStacks = [
            ['name' => 'HTML5', 'category' => 'Frontend', 'icon' => 'https://cdn.simpleicons.org/html5'],
            ['name' => 'PHP', 'category' => 'Backend', 'icon' => 'https://cdn.simpleicons.org/php'],
            ['name' => 'Laravel', 'category' => 'Backend', 'icon' => 'https://cdn.simpleicons.org/laravel'],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'icon' => 'https://cdn.simpleicons.org/javascript'],
            ['name' => 'Next.js', 'category' => 'Frontend', 'icon' => 'https://cdn.simpleicons.org/nextdotjs/ffffff'],
            ['name' => 'MySQL', 'category' => 'Database', 'icon' => 'https://cdn.simpleicons.org/mysql'],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'icon' => 'https://cdn.simpleicons.org/tailwindcss'],
            ['name' => 'Bootstrap', 'category' => 'Frontend', 'icon' => 'https://cdn.simpleicons.org/bootstrap'],
            ['name' => 'Git', 'category' => 'Tools', 'icon' => 'https://cdn.simpleicons.org/git'],
            ['name' => 'GitHub', 'category' => 'Tools', 'icon' => 'https://cdn.simpleicons.org/github/ffffff'],
        ];

        foreach ($techStacks as $index => $stack) {
            TechStack::updateOrCreate(
                ['name' => $stack['name']],
                [
                    'category' => $stack['category'],
                    'icon' => $stack['icon'],
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
