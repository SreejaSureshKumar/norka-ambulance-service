<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenericController extends Controller
{
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (!Auth::check() ) {
            $query_params = $request->all();
            return redirect()->route('login', $query_params);
        }
        return redirect()->intended('login');
    }
}
