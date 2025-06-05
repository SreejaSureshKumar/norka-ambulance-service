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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $usertypes = UserType::where('usertype_status', 1)->pluck('usertype_name', 'id')->all();

        $usercomponents = UserComponent::where('component_status', 1)->pluck('component_name', 'component_id')->all();

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

    public function edit($id): View
    {
        $id = decrypt($id);
        $permission = \App\Models\ComponentPermission::findOrFail($id);

        $usertype = $permission->usertype;
        $mappedComponent = $permission->component;
        $parentComponent = $mappedComponent && $mappedComponent->component_parent
            ? \App\Models\UserComponent::find($mappedComponent->component_parent)
            : null;

        // Get all children of the parent component for the select box
        $childComponents = $parentComponent
            ? \App\Models\UserComponent::where('component_parent', $parentComponent->component_id)->pluck('component_name', 'component_id')->all()
            : [];

        return view('permissions.edit', compact(
            'permission',
            'usertype',
            'mappedComponent',
            'parentComponent',
            'childComponents'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $id = decrypt($id);
        $permission = ComponentPermission::findOrFail($id);

        $rules = [
            'component_id' => 'required|exists:component,component_id',
            'permission_status' => 'required|in:0,1',
        ];

        $validated = $request->validate($rules);

        $permission->component_id = $validated['component_id'];
        $permission->permission_status = $validated['permission_status'];
        $permission->save();

        return redirect()->route('userpermission.index')
            ->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $id = decrypt($id);
        ComponentPermission::find($id)->delete();
        return redirect()->route('userpermission.index')
            ->with('success', 'Permission revoked successfully');
    }
}
