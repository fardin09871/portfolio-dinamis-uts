<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = app('currentAdmin');

        return view('admin.dashboard', compact('admin'));
    }
}
