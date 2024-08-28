<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Hash;
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

    public function checkEmailExists(Request $request)
    {
        // Obtener el email de la solicitud
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            // El email existe y la contraseña es correcta
            //return response()->json(true);
            return response()->json($user);
        } else {
            // El email no existe o la contraseña es incorrecta
            //return response()->json(false);

            // esta sería la forma correcta, con un texto y código
            // return response()->json(['error' => 'Invalid credentials'], 401);

            // pero por ahora no no devolveré nada.
            return response()->json(null);
        }
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
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 128 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, números, guiones y guiones bajos.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'status.required' => 'El campo estado es obligatorio.',
        ];

      $data = $request->validate([
              'name' => ['required', 'max:128', 'regex:/^[\pL\pM\pN_-]+$/u'],
              'email'=> 'required|email|unique:users',
              'password' => 'required|confirmed',
              'status' => 'required'
      ], $messages);
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
