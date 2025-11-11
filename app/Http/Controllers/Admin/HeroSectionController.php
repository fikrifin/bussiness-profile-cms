<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HeroSectionController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/HeroSections/Index', [
            'items' => HeroSection::orderByDesc('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url',
            'background_image' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        HeroSection::create($data);
        return back();
    }

    public function update(Request $request, HeroSection $hero_section)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url',
            'background_image' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        $hero_section->update($data);
        return back();
    }
}
