<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Rules\PhoneNumber;
use App\Rules\Password;
use App\Rules\AlphaSpace;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Always redirect to login with success message
        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect()->route('login')->with('status', 'Successfully Registered!');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (empty($data['mobile_country_code']) || empty($data['mobile_country_iso_code'])) {
            $data['mobile_country_code'] = '91';
            $data['mobile_country_iso_code'] = 'in';
        }
        $iso_code = strtoupper($data['mobile_country_iso_code']);
        return Validator::make($data, [
            'first_name' => ['required', new AlphaSpace, 'min:2', 'max:100'],
            'middle_name' => ['nullable', new AlphaSpace, 'min:1', 'max:100'],
            'last_name' => ['required', new AlphaSpace, 'min:1', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'user_mobile' => ['required', new PhoneNumber($iso_code), 'max:25'],
            'password' => ['required', new Password, 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'The email has already been registered.',
            
            'first_name.regex' => 'The first name field must only contain allowed characters.',
            'middle_name.regex' => 'The middle name field must only contain allowed characters.',
            'last_name.regex' => 'The last name field must only contain allowed characters.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'] ?? '',
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'user_mobile' => $data['user_mobile'],
            'password' => Hash::make($data['password']),
            'user_status' => 1,
            'user_type' => 2
        ]);
    }
}
