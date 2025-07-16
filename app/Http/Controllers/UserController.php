<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Rules\PhoneNumber;
use App\Rules\Password;
use App\Rules\AlphaSpace;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //      $this->middleware('permission:user-list|user-create', ['only' => ['index','store']]);
    //      $this->middleware('permission:user-create', ['only' => ['create','store']]);

    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = User::latest()->get();

        return view('users.index', compact('data'))
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

        return view('users.create', compact('usertypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {


        $validatedData = $request->validate([
            'first_name' => ['required', new AlphaSpace, 'min:2', 'max:100'],
            'middle_name' => ['nullable', new AlphaSpace, 'min:1', 'max:100'],
            'last_name' => ['required', new AlphaSpace, 'min:1', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'user_mobile' => ['required', new PhoneNumber('IN'), 'max:25'],
            'password' => ['required', new Password, 'min:8', 'same:confirm-password'],
            'user_type' => ['required', 'numeric'],
            'user_status' => ['required', 'numeric'],
        ],[], [
            'first_name' => 'Full Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',

            'user_type' => 'Usertype',

            'user_status' => 'Status',
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        // $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
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
        $user = User::find($id);
        $usertypes = UserType::pluck('usertype_name', 'id')->all();

        return view('users.show', compact('user', 'usertypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {

        $id = decrypt($id);
        $user = User::find($id);

        $usertypes = UserType::pluck('usertype_name', 'id')->all();

        return view('users.edit', compact('user', 'usertypes'));
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
        $validatedData = $request->validate([
            'first_name' => ['required', new AlphaSpace, 'min:2', 'max:100'],
            'middle_name' => ['nullable', new AlphaSpace, 'min:1', 'max:100'],
            'last_name' => ['required', new AlphaSpace, 'min:1', 'max:100'],
            'email' => 'required|email|unique:users,email,' . $id,
            'user_mobile' => ['required', new PhoneNumber('IN'), 'max:25'],
            'password' => ['nullable', new Password, 'min:8', 'same:confirm-password'],
            'user_type' => ['required', 'numeric'],
            'user_status' => ['required', 'numeric'],
        ],[], [
            'first_name' => 'Full Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'user_type' => 'Usertype',
            'user_status' => 'Status',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        // Remove assignRole if not using roles
        // $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
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
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('users.index')
                ->with('error', 'User not found');
        }
    }
}
