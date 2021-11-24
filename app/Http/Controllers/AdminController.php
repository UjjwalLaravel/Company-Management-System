<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AdminController extends Controller
{
    // Function for dashboard
    public function dashboard()
    {
        $user = FacadesAuth::user();
        $proj_count = Tender::where('project_type', 'Project')->count();
        $main_count = Tender::where('project_type', 'Maintenance')->count();
        return view('dashboard', compact('proj_count', 'main_count'));
    }
}
