<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Testimonials/Index', [
            'items' => Testimonial::orderByDesc('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'author' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'avatar' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        Testimonial::create($data);
        return back();
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'author' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'avatar' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        $testimonial->update($data);
        return back();
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back();
    }
}
