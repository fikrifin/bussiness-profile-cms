<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactInfoController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/ContactInfo/Index', [
            'item' => ContactInfo::first(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'map_embed' => 'nullable|string',
        ]);
        ContactInfo::query()->delete();
        ContactInfo::create($data);
        return back();
    }
}
