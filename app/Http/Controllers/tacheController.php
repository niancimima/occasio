<?php

namespace App\Http\Controllers;
use App\Models\Tache;


use Illuminate\Http\Request;

class tacheController extends Controller
{
    public function ajouter(Request $request) {
        Tache::create($request->all());
        return response()->json("Bien ajouté",200);  
    }
    public function afficher($event_id)
    {
        $listeTache=Tache::where('event_id',$event_id)->get();
        return   $listeTache;
    }
    public function terminer($tache_id)
    {
        $tache=Tache::find($tache_id);
        $tache->update(['etat' => 'terminer']);
        return response()->json("La tache est bien modifiée",200);  
    }
    public function supprimer($tache_id) {
        $tache=Tache::find($tache_id);
        $tache->delete();
        return response()->json("La tache est bien supprimée",200);  
    }

}
