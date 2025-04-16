<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prestataire;


class prestataireController extends Controller
{
    public function modifier(Request $request) {
    $token = $request->header('Authorization');

    if (!$token) {
        return response()->json(['error' => 'Token not provided'], 401);
    }

    $token = str_replace('Bearer ', '', $token);
    $user = User::where('api_token', $token)->first();
    $prestataire = $user->prestataire;
    return response()->json(['prestataire' => $prestataire], 200);    
    }

    public function update(Request $request,$id) {
        $prestataire = Prestataire::findOrfail($id);
        if($prestataire) {
            $prestataire->update($request->all());
            return response()->json("Bien Modifié",200);
        } else {
            return response()->json("not Found",404);
        }
        
    }

}
