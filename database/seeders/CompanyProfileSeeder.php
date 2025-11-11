<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyProfile::firstOrCreate([], [
            'about_text' => 'Kami adalah perusahaan yang fokus pada inovasi dan layanan berkualitas.',
            'mission' => 'Memberikan solusi terbaik untuk kemajuan bisnis klien.',
            'vision' => 'Menjadi mitra strategis nomor satu di industri digital.',
            'address' => 'Jl. Contoh No. 123, Jakarta',
        ]);
    }
}
