<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserType;
use App\Models\ComponentPermission;
use App\Models\UserComponent;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ComponentPermissionController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
       
        $permissions = ComponentPermission::latest()->get();
      

        return view('permissions.index', compact('permissions'));
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $usertypes = UserType::pluck('usertype_name', 'id')->all();
        $usercomponents = UserComponent::pluck('component_name', 'component_id')->all();

        return view('permissions.create', compact('usercomponents', 'usertypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'user_type' => 'required|exists:usertype,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:component,component_id',
        ]);

        $usertypeId = $request->input('user_type');
        $componentIds = $request->input('permissions');

        // Remove existing permissions for this usertype (optional, for "replace" behavior)
        \App\Models\ComponentPermission::where('usertype_id', $usertypeId)->delete();

        // Assign each selected component to the usertype
        foreach ($componentIds as $componentId) {
            \App\Models\ComponentPermission::create([
                'usertype_id' => $usertypeId,
                'component_id' => $componentId,
                'permission_status' => 1, // or set based on your logic/UI
            ]);
        }

        return redirect()->route('userpermission.index')
            ->with('success', 'Permissions assigned successfully');
    }
}
