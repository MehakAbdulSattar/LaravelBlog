<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //controller index function run against admin view route
    //at this route we return admin dashboard page
    public function index()
    {
        return view('admin.dashboard');
    }
}
