<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CaptchaService;
use Illuminate\Support\Facades\Validator;
use App\Rules\AlphaSpace;
use App\Rules\Password;

class CaptchaController extends Controller
{
    public function image(Request $request, CaptchaService $captcha)
    {
        if ($request->isMethod('post')) {
            // For AJAX refresh: return data URI
            return response()->json('data:image/png;base64,' . $captcha->generate());
        } else {
            // For <img src="...">: return image directly
            $imageData = base64_decode($captcha->generate());
            return response($imageData)->header('Content-Type', 'image/png');
        }
    }
    public function validateUser(Request $request)
    {

        $field_name = $request->field_name;
        $rules = [
            'first_name' => ['required', new AlphaSpace, 'min:2', 'max:100'],
            'middle_name' => ['nullable', new AlphaSpace, 'min:1', 'max:100'],
            'last_name' => ['required', new AlphaSpace, 'min:1', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', new Password, 'min:8'],
        ];
        $validator = Validator::make($request->all(), [
            $field_name => $rules[$field_name],
        ], [], [
            'first_name' => 'first name ',
            'middle_name' => 'middle name',
            'last_name' => 'last name',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        return response()->json(['success' => true]);
    }
}
