<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with(['menus' => function($query) {
            $query->where('is_available', true);
        }])->get();

        $settings = Setting::pluck('value', 'key');

        return view('home', compact('categories', 'settings'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Pesan Anda telah terkirim! Terima kasih telah menghubungi kami.');
    }
}
