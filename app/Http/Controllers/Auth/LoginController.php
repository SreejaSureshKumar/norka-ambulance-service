<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
    
        // Custom login view location
        return view('login');
    }
  
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
       
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }


    protected function credentials(Request $request)
    {
     
        $user_login = $request->input($this->username());
        $validator = Validator::make(['email' => $user_login], [
            'email' => 'email',
        ]);
        $field_type = $validator->fails() ? 'user_mobile' : 'email';
        return [
            $field_type => $user_login,
            'password' => $request->input('password'),
        ];
    }

     /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
      
        return 'user_login';
    }
     /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
     
            return $request->wantsJson() ? new JsonResponse([], 204) : redirect()->intended($this->redirectPath());
    }
}
