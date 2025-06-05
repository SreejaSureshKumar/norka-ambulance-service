<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function admindashboard()
    {

        return view('adminuser.dashboard');
    }
    public function userdashboard()
    {
        return view('beneficiary.dashboard');
    }
    public function officialdashboard()
    { // Fetch counts for new and processed applications
        $newApplications = Application::where('application_status', 1)->count();
        $processedApplications = Application::where('application_status', 2)->count();

        // Pass the counts to the view
        return view('official.dashboard', compact('newApplications', 'processedApplications'));
    }
}
