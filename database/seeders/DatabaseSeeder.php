<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\HeroSectionSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\TestimonialSeeder;
use Database\Seeders\CompanyProfileSeeder;
use Database\Seeders\ContactInfoSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $this->call([
            HeroSectionSeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,
            CompanyProfileSeeder::class,
            ContactInfoSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
