<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSection::firstOrCreate([
            'title' => 'Selamat Datang di Perusahaan Kami',
        ], [
            'subtitle' => 'Kami menyediakan solusi terbaik untuk kebutuhan bisnis Anda.',
            'button_text' => 'Pelajari Lebih Lanjut',
            'button_url' => '#services',
            'background_image' => null,
            'is_active' => true,
        ]);
    }
}
