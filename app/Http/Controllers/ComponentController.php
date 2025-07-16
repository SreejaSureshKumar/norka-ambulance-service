<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserComponent;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = UserComponent::latest()->get();

        return view('usercomponent.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {

        $usercomponents = UserComponent::where('component_parent', '=', 0)->pluck('component_name', 'component_id')->all();

        return view('usercomponent.create', compact('usercomponents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request data
        $this->validate($request, [
            'component_name' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            'component_path' => 'nullable|string|max:255|regex:/^[a-zA-Z._-]+$/',
            'component_order' => 'required|numeric',
            'component_status' => 'required|numeric',
            'component_icon' => 'nullable|string|max:255|regex:/^[a-zA-Z]+(?:[ -][a-zA-Z]+)*$/',
            'component_parent' => 'nullable|numeric'
        ]);

        $input = $request->all();

        $user = UserComponent::create($input);
    

        return redirect()->route('usercomponent.index')
            ->with('success', 'Component created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $id = decrypt($id);
        
        $usercomponent = UserComponent::with('parentComponent')->find($id);
        
        $usercomponents = UserComponent::where('component_parent', '=', 0)->pluck('component_name', 'component_id')->all();
        return view('usercomponent.show', compact('usercomponent', 'usercomponents'));
    }
public function edit($id): View
{
    $id = decrypt($id);
    $usercomponent = UserComponent::find($id);
    
    // Get only components that can be parents (main menus) and exclude current component
    $usercomponents = UserComponent::where('component_parent', 0)
        ->where('component_id', '!=', $id)
        ->pluck('component_name', 'component_id')
        ->all();
    
    return view('usercomponent.edit', compact('usercomponent', 'usercomponents'));
}

public function update(Request $request, $id): RedirectResponse
{
    $id = decrypt($id);
    $usercomponent = UserComponent::find($id);
    
    // Check if this component has any children
    $hasChildren = UserComponent::where('component_parent', $usercomponent->component_id)->exists();
    
    $this->validate($request, [
        'component_name' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
        'component_path' => 'nullable|string|max:255|regex:/^[a-zA-Z._-]+$/',
        'component_order' => 'required|numeric',
        'component_status' => 'required|numeric',
        'component_icon' => 'nullable|string|max:255|regex:/^[a-zA-Z]+(?:[ -][a-zA-Z]+)*$/',
        'component_parent' => 'nullable|numeric'
    ]);
    
    $input = $request->all();
    
    // If component has children, force parent to be 0 (main menu)
    if ($hasChildren) {
        $input['component_parent'] = 0;
    }
    
    $usercomponent->update($input);
    
    return redirect()->route('usercomponent.index')
                    ->with('success', 'Component updated successfully');
}
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $id=decrypt($id);
        UserComponent::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','Component deleted successfully');
    }
}
