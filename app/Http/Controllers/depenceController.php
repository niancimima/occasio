<?php

namespace App\Http\Controllers;
use App\Models\Depense;
use App\Models\Evenement;


use Illuminate\Http\Request;

class depenceController extends Controller
{
    public function ajouter(Request $request) {
        Depense::create($request->all());
        return response()->json("Bien ajoutée",200);  
    }
    public function afficher($event_id)
    {
        $event = Evenement::find($event_id);
        $budget=$event['budget'];
        $listeDepence=Depense::where('event_id',$event_id)->get();
        $reste=$budget;
        for ($i=0;$i<count($listeDepence);$i++) {
            $reste = $reste-$listeDepence[$i]->montant ;
        }
        return   ["reste"=>$reste,
                    "listeDepence"=>$listeDepence];
    }
    public function supprimer($id) {
        $depense=Depense::find($id);
        $depense->delete();
        return response()->json("Bien supprimée",200);  
    }
    public function modifier($id) {
        $depense = Depense::findOrfail($id);
        if($depense) {
            return response()->json(["depense"=>$depense],200);
        } else {
            return response()->json("not Found",404);
        }
    }
    public function update(Request $request,$id) {
        $depense = Depense::findOrfail($id);
        if($depense) {
            $depense->update($request->all());
            return response()->json("Bien Modifiée",200);
        } else {
            return response()->json("not Found",404);
        }

    }


}
