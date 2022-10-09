<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        echo "index";
    }

    public function store(Request $request)
    {
        return User::create([
            'token_device' => $request['token_device'],
            'status' => 1
        ]);
    }
}
