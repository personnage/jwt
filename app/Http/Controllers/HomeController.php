<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        return ['Welcome '.$user->username];
    }
}
