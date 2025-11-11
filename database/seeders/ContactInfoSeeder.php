<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactInfo::firstOrCreate([], [
            'email' => 'info@perusahaan.com',
            'phone' => '+62 812-3456-7890',
            'address' => 'Jl. Contoh No. 123, Jakarta',
            'map_embed' => null,
        ]);
    }
}
