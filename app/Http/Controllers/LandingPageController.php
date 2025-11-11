<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\ContactInfo;
use App\Models\HeroSection;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Landing/Index', [
            'hero' => HeroSection::where('is_active', true)->orderByDesc('id')->first(),
            'services' => Service::orderBy('sort_order')->get(),
            'testimonials' => Testimonial::where('is_active', true)->latest()->take(6)->get(),
            'company' => CompanyProfile::first(),
            'contact' => ContactInfo::first(),
            'settings' => Setting::all()->keyBy('key')->map->value,
        ]);
    }
}
