<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Prestataire;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,role_id',

        ]);

        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'api_token' => Str::random(60)
        ]);
        if($request->role_id==2) {
            $request->validate([
                'nom' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string|min:6|confirmed',
                'role_id' => 'required|exists:roles,role_id',
                'type' => 'required|string',
                'adresse' =>  'required|string',
                'telephone' =>  'required|string',
                'adresse' =>  'required|string',
                'site_web' => '',
                'description' => '',
    
            ]);    
            
            Prestataire::create([
                'user_id' => $user['id'],
                'type' => $request->type,
                'telephone' => $request->telephone,
                'adresse' =>$request->adresse,
                'site_web' => $request->site_web,
                'description' => $request->description,
            ]);

        }

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = Str::random(60);
            $user->api_token = $token;
            $user->save();

            return response()->json(['token' => $token,
                                        'role'=>$user->role_id], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}