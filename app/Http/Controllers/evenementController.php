<?php

namespace App\Http\Controllers;
use App\Models\Evenement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class evenementController extends Controller
{
    public function ajouter(Request $request) {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $user = User::where('api_token', $token)->first();
        $request->merge(['user_id' => $user->id]);
        $event = Evenement::create($request->all());
        return response()->json([ "event_id" => $event->event_id],200);  
    }
    public function afficher(Request $request)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $user = User::where('api_token', $token)->first();

        $listeEvenement=Evenement::where('user_id',$user->id)->get();
        return response()->json([
            'listeEvenement' => $listeEvenement,
            'user' => $user
        ], 200);    }
    public function detail($event_id)
    {
        $evenement=Evenement::find($event_id);
        $numberTaches = $evenement->taches->count();
        $numberInvites = $evenement->invites->count();
        $numberDepeneses = $evenement->depenses->count();
        $numberActivites = $evenement->activites->count();
        return   [
            'evenement' => $evenement,
            'numberTaches' => $numberTaches,
            'numberInvites' => $numberInvites,
            'numberDepeneses' => $numberDepeneses,
            'numberActivites' => $numberActivites,
        ];
    }
    public function supprimer($id) {
        $evenement=Evenement::find($id);
        $evenement->delete();
        return response()->json("Bien supprimé",200);  
    }
    public function modifier(Request $request,$id) {
        $evenement=Evenement::find($id);
        $evenement->update($request->all());
        return response()->json("Bien Modifié",200);  
    }
    public function update(Request $request,$id) {
        $evenement=Evenement::find($id);
        $evenement->update($request->all());
        return response()->json("Bien modifié",200);  
    }

}
