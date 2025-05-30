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
        // dd($request->all());
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
        // $user->assignRole($request->input('roles'));

        return redirect()->route('usercomponent.index')
            ->with('success', 'Component created successfully');
    }
}
