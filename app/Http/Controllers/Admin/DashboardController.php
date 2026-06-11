<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_menus' => Menu::count(),
            'total_categories' => Category::count(),
            'total_messages' => Contact::count(),
            'unread_messages' => Contact::where('is_read', false)->count(),
        ];

        $recent_activities = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_activities'));
    }
}
