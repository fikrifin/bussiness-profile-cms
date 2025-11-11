<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/CompanyProfile/Index', [
            'item' => CompanyProfile::first(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'about_text' => 'required|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'address' => 'nullable|string',
        ]);
        CompanyProfile::query()->delete();
        $item = CompanyProfile::create($data);
        return back();
    }
}
