<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'author' => 'Andi Pratama',
                'role' => 'CEO StartupX',
                'content' => 'Tim ini membantu kami mempercepat transformasi digital dengan hasil yang nyata.',
                'avatar' => null,
                'is_active' => true,
            ],
            [
                'author' => 'Siti Lestari',
                'role' => 'Marketing Manager',
                'content' => 'Strategi pemasaran mereka meningkatkan leads dan brand awareness kami.',
                'avatar' => null,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate([
                'author' => $t['author'],
                'content' => $t['content'],
            ], $t);
        }
    }
}
