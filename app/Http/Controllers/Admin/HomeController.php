<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            "title" => "Dashboard"
        ]);
    }
}
