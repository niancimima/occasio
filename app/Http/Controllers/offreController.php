<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offre;
use App\Models\Prestataire;
use Illuminate\Support\Facades\Auth;

class offreController extends Controller
{

    public function ajouter(Request $request) {
        $token = $request->header('Authorization');
    
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
    
        $token = str_replace('Bearer ', '', $token);
        $user = User::where('api_token', $token)->first();
    
        if (!$user) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    
        if (!$user->prestataire) {
            return response()->json(['error' => 'User does not have an associated prestataire'], 400);
        }
    
        $request->merge(['prestataire_id' => $user->prestataire->id]);
    
        $image = $request->file('image');
        if (!$image) {
            return response()->json(['error' => 'Image not provided'], 400);
        }
    
        $extension = $image->getClientOriginalExtension();
        if (!in_array($extension, ['jpg', 'png', 'jpeg'])) {
            return response()->json(['error' => "L'image doit être au format jpg, png, ou jpeg."], 400);
        } else {
            $numeroUnique = uniqid();
            $imagePath = 'images/' . $numeroUnique . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imagePath);
            $data = $request->all();
            $data['image_url'] = $imagePath;
        }
    
        $offre = Offre::create($data);
        return response()->json(['offre_id' => $offre->id], 200);
    }
    

    public function afficher(Request $request)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $user = User::where('api_token', $token)->first();

        $listeOffre=Offre::with("prestataire.user")->where('prestataire_id',$user->prestataire->id)->get();
        return response()->json(['listeOffres' => $listeOffre], 200);    
    }
    public function afficherTous(Request $request)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $token = str_replace('Bearer ', '', $token);
        $user = User::where('api_token', $token)->first();

        $listeOffre = Offre::with('prestataire.user')->get();
        return response()->json(['listeOffres' => $listeOffre], 200);    
    }
    public function recherche(Request $request,$value)
    {
        $listeOffre = Offre::with('prestataire.user')
            ->where('titre', 'like', "%{$value}%")
            ->orWhere('description', 'like', "%{$value}%")
            ->get();
        return response()->json(['listeOffres' => $listeOffre], 200);    
    }
    public function recherchePres(Request $request,$prestataire_id)
    {
        $listeOffre = Offre::with('prestataire.user')
            ->where('prestataire_id', 'like', $prestataire_id)
            ->get();
        $prestataire = Prestataire::find($prestataire_id);
        return response()->json(['listeOffres' => $listeOffre,
                                'prestataire' => $prestataire] , 200);    
    }

    public function detail($id)
    {
        $offre=Offre::find($id);
        return   $offre;
    }
    public function supprimer($id) {
        $offre=Offre::find($id);
        $offre->delete();
        return response()->json("Bien supprimée",200);  
    }
    public function modifier($id) {
        $offre=Offre::find($id);
        return $offre;
    }
    public function update(Request $request,$id) {
        $offre=Offre::find($id);
        $offre->update($request->all());
        return response()->json("Bien modifiée",200);  
    }

}
