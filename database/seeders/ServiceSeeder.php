<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Konsultasi Bisnis', 'description' => 'Pendampingan strategi dan operasional bisnis.', 'icon' => 'ph:handshake', 'sort_order' => 1],
            ['name' => 'Pengembangan Website', 'description' => 'Membangun website modern dan cepat.', 'icon' => 'ph:globe', 'sort_order' => 2],
            ['name' => 'Digital Marketing', 'description' => 'Optimasi SEO, iklan, dan konten.', 'icon' => 'ph:megaphone', 'sort_order' => 3],
        ];

        foreach ($services as $svc) {
            Service::updateOrCreate(
                ['name' => $svc['name']],
                $svc
            );
        }
    }
}
