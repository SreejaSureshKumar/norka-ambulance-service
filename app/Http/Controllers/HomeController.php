<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ServiceApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use App\Models\UserComponent;

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
        $user = Auth::user();
        $userTypeId = $user->usertype;

        $components = Auth::user()->getCurrentUserPermissions();


        $mainMenus = array();


        // Group the main menu.
        foreach ($components as $component) {
            $component_id = $component->component_id;
            if ($component->component_parent === 0) {
                // First try to use main menu's own route if it exists
                if (!empty($component->component_path)) {
                    $route_name = $component->component_path;
                } else {
                    $first_submenu = UserComponent::where('component_status', 1)
                        ->where('component_parent', $component->component_id)
                        ->whereNotNull('component_path')
                        ->first();
                    // Assign submenu route if exists, otherwise use '#'
                    $route_name = $first_submenu ? $first_submenu->component_path : '#';
                }


                $mainMenus[$component_id] = [
                    'name' => $component->component_name,
                    'icon' => $component->component_icon,
                    'route_name' => $route_name,


                ];
            }
        }



        return view('adminuser.dashboard', compact('mainMenus'));
    }
    public function userdashboard()
    {
        return view('beneficiary.dashboard');
    }
    public function officialdashboard()
    {
        // Death Repatriation counts
    $deathRepatriation = [
        'new' => Application::where('application_status', 1)->count(),
        'approved' => Application::where('application_status', 2)->count(),
        'rejected' => Application::where('application_status', 3)->count()
    ];

    // Ambulance Service counts
    $ambulanceService = [
        'new' => ServiceApplication::where('application_status', 1)->count(),
        'approved' => ServiceApplication::where('application_status', 2)->count(),
        'rejected' => ServiceApplication::where('application_status', 3)->count()
    ];

    return view('official.dashboard', compact('deathRepatriation', 'ambulanceService'));
    }
}
