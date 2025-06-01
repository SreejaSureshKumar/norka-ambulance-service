<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use App\Services\CaptchaService;
use App\Services\AuthRedirector;

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
     * Captcha service instance.
     *
     * @var \App\Services\CaptchaService
     */
    protected $captcha;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\CaptchaService $captcha
     * @return void
     */
    public function __construct(CaptchaService $captcha)
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
        $this->captcha = $captcha;
    }

    public function showLoginForm()
    {
        $captcha_src = $this->captcha->getSrc();
        // Custom login view location
        return view('login', compact('captcha_src'));
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
            'captcha' => 'required|alpha_num:ascii|size:6',
        ], [
            'captcha.alpha_num' => 'Invalid CAPTCHA',
        ]);

        if (!$this->captcha->validate($request->captcha)) {
            throw ValidationException::withMessages([
                'captcha' => ['Invalid CAPTCHA'],
            ]);
        }
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
    // protected function authenticated(Request $request, $user)
    // {

    //         return $request->wantsJson() ? new JsonResponse([], 204) : redirect()->intended($this->redirectPath());
    // }
    protected function authenticated(Request $request, $user)
    {
        
        return redirect()->route(app(AuthRedirector::class)->getRedirectRoute());

    }
}
