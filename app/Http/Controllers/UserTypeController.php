<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserType;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserTypeController extends Controller
{
   
   
    // function __construct()
    // {
    //      $this->middleware('permission:usertype-list|usertype-create', ['only' => ['index','store']]);
    //      $this->middleware('permission:usertype-create', ['only' => ['create','store']]);
    
    // }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = UserType::latest()->get();
  
        return view('usertype.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
               
        $usertypes = UserType::pluck('usertype_name', 'id')->all();

        return view('usertype.create',compact('usertypes'));
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
            'usertype_name' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            
            'usertype_status' => 'required|numeric'
        ]);
    
        $input = $request->all();
       
        
    
        $user = UserType::create($input);
        // $user->assignRole($request->input('roles'));
    
        return redirect()->route('usertypes.index')
                        ->with('success','Usertype created successfully');
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $id=decrypt($id);
        $usertype = UserType::find($id);

        return view('usertype.show',compact('usertype'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        
        $id=decrypt($id);
        $usertype = UserType::find($id);     
    
        return view('usertype.edit',compact('usertype'));
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
        $id=decrypt($id);
       
        $this->validate($request, [
            'usertype_name' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            
            'usertype_status' => 'required|numeric'
        ]);
    
        $input = $request->all();
       
        $usertype = UserType::find($id);
        $usertype->update($input);

        return redirect()->route('usertypes.index')
                        ->with('success','Usertype updated successfully');
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
        UserType::find($id)->delete();
        return redirect()->route('usertypes.index')
                        ->with('success','Usertype deleted successfully');
    }
}
