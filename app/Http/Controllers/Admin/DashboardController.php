<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Staff;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'staff' => Staff::count(),
            'categories' => Category::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
