<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CaptchaService;

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
}
