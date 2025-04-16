<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activite;


class activiteController extends Controller
{
    public function ajouter(Request $request) {
        Activite::create($request->all());
        return response()->json("Bien ajoutée",200);  
    }
    public function afficher($event_id)
    {
        $listeActivite=Activite::where('event_id',$event_id)->get();
        return   $listeActivite;
    }
    public function supprimer($id) {
        $activite = Activite::find($id);
        $activite->delete();
        return response()->json("Bien suprimé",200);  
    }
    public function modifier($id) {
        $activite = Activite::findOrfail($id);
        if($activite) {
            return response()->json(["activite"=>$activite],200);
        } else {
            return response()->json("not Found",404);
        }
    }
    public function update(Request $request,$id) {
        $activite = Activite::findOrfail($id);
        if($activite) {
            $activite->update($request->all());
            return response()->json("Bien Modifiée",200);
        } else {
            return response()->json("not Found",404);
        }
    }

}
