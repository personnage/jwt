<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return $this->respond($request->user());
    }
}
