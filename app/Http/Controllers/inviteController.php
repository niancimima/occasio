<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{
    public function ajouter(Request $request) {
        Invite::create($request->all());
        return response()->json("Bien ajouté", 200);
    }

    public function afficher($event_id) {
        $listeInvite = Invite::where('event_id', $event_id)->get();
        return $listeInvite;
    }

    public function supprimer($id) {
        $invite = Invite::findOrFail($id);
        if ($invite) {
        $invite->delete();
        return response()->json("Bien suprimé", 200);
        } else {
            return response()->json("not Found", 404);
        }
    }

    public function modifier($id) {
        $invite = Invite::findOrFail($id);
        if ($invite) {
            return response()->json(["invite" => $invite], 200);
        } else {
            return response()->json("not Found", 404);
        }
    }

    public function update(Request $request, $id) {
        $invite = Invite::findOrFail($id);
        if ($invite) {
            $invite->update($request->all());
            return response()->json("Bien Modifié", 200);
        } else {
            return response()->json("not Found", 404);
        }
    }

    public function envoyerEmail( $id) {
        $invite = Invite::findOrFail($id);
        $event = $invite->evenement;
        if ($invite) {
            $invite->update(['invité' => 1]);
            return response()->json(["invite" => $invite,
                                    "evenement" => $event], 200);
        } else {
            return response()->json("not Found", 404);
        }
    }
}
