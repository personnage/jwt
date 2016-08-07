<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        return [
            'message' => sprintf('Hello, %s', $user->username),
        ];
    }
}
