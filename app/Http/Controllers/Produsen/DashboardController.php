<?php

namespace App\Http\Controllers\Produsen;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('produsen.dashboard');
    }
}
