<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\ContactInfo;
use App\Models\HeroSection;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('dashboard.stats', 60, function () {
            return [
                'users' => User::count(),
                'services' => Service::count(),
                'testimonials' => Testimonial::count(),
                'hero_active' => HeroSection::where('is_active', true)->count(),
                'company_profile_exists' => CompanyProfile::query()->exists(),
                'contact_info_exists' => ContactInfo::query()->exists(),
            ];
        });

        $activity = Cache::remember('dashboard.activity', 60, function () {
            $items = [];

            $services = Service::orderByDesc('updated_at')->limit(5)->get()
                ->map(fn ($s) => [
                    'type' => 'service',
                    'title' => $s->name,
                    'updated_at' => $s->updated_at?->toIso8601String(),
                ]);

            $testimonials = Testimonial::orderByDesc('updated_at')->limit(5)->get()
                ->map(fn ($t) => [
                    'type' => 'testimonial',
                    'title' => $t->author,
                    'updated_at' => $t->updated_at?->toIso8601String(),
                ]);

            $heroes = HeroSection::orderByDesc('updated_at')->limit(5)->get()
                ->map(fn ($h) => [
                    'type' => 'hero',
                    'title' => $h->title,
                    'updated_at' => $h->updated_at?->toIso8601String(),
                ]);

            $company = CompanyProfile::orderByDesc('updated_at')->limit(1)->get()
                ->map(fn ($c) => [
                    'type' => 'company_profile',
                    'title' => 'Profil Perusahaan diperbarui',
                    'updated_at' => $c->updated_at?->toIso8601String(),
                ]);

            $contacts = ContactInfo::orderByDesc('updated_at')->limit(1)->get()
                ->map(fn ($c) => [
                    'type' => 'contact_info',
                    'title' => 'Kontak diperbarui',
                    'updated_at' => $c->updated_at?->toIso8601String(),
                ]);

            $users = User::orderByDesc('created_at')->limit(3)->get()
                ->map(fn ($u) => [
                    'type' => 'user',
                    'title' => 'User baru: ' . ($u->name ?? $u->email),
                    'updated_at' => $u->created_at?->toIso8601String(),
                ]);

            $items = $services
                ->merge($testimonials)
                ->merge($heroes)
                ->merge($company)
                ->merge($contacts)
                ->merge($users)
                ->all();

            // Sort combined list by updated_at desc and keep top 10
            usort($items, function ($a, $b) {
                return strcmp($b['updated_at'] ?? '', $a['updated_at'] ?? '');
            });

            return array_values(array_slice($items, 0, 10));
        });

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'activity' => $activity,
        ]);
    }
}
