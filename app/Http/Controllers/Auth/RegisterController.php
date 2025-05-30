<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Rules\PhoneNumber;
use App\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

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
        dd($request->all());
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
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
            'first_name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:2', 'max:100'],
            'middle_name' => ['nullable', 'regex:/^[a-zA-Z\s]+$/', 'min:1', 'max:100'],
            'last_name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:1', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'mobile' => ['required', new PhoneNumber($iso_code), 'max:25', 'unique:users,user_mobile'],
            'password' => ['required', new Password, 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'The email has already been registered.',
            'mobile.unique' => 'The mobile has already been registered.',
            'first_name.regex' => 'The first name field must only contain letters and spaces.',
            'middle_name.regex' => 'The middle name field must only contain letters and spaces.',
            'last_name.regex' => 'The last name field must only contain letters and spaces.',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
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
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'user_status' => 1,
            
        ]);
    }
}
