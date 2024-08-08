<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('*')->get();
        return response()->json([
            'count' => count($users),
            'items' => $users
        ]);
    }

    public function store(Request $request)
    {
        $token_receive = $request['token_device'];

        $tokenExist = User::select('*')
            ->where('users.token_device', '=', $request->input('token_device'))
            ->get();
        
        if (count($tokenExist) == 0) {
            return User::create([
                'token_device' => $request['token_device'],
                'status' => 1
            ]);
        } else {
            return response()->json([
                'msg' => 'Este dispositivo ya ha sido registrado'
            ]);
        }
    }

    public function register(Request $request)
    {
      $data = $request->validate([
              'name' => 'required|max:128',
              'email'=> 'required|email|unique:users',
              'password' => 'required|confirmed',
              'status' => 'required'
      ]);
      // Encriptar la contraseña
      $data['password'] = bcrypt($data['password']);
      
      $user = User::create($data);
      $token = $user->createToken($request->name);

      return [
              'user' => $user,
              'token'=> $token->plainTextToken
      ];
    }
}
