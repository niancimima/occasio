<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\evenementController;
use App\Http\Controllers\tacheController;
use App\Http\Controllers\inviteController;
use App\Http\Controllers\depenceController;
use App\Http\Controllers\activiteController;
use App\Http\Controllers\offreController;
use App\Http\Controllers\prestataireController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/roles', [roleController::class, 'index']);
Route::get('/acceuil',[userController::class,'acceuil']);

Route::post('/ajouterEvenement',[evenementController::class,'ajouter']);
Route::get('/detailEvent/{event_id}',[evenementController::class,'detail']);
Route::get('/listeEvenement',[evenementController::class,'afficher'])->name('listeEvenement');
Route::post('/supprimerEvent/{id}',[evenementController::class,'supprimer']);
Route::post('/modifierEvent/{event_id}',[evenementController::class,'modifier']);
Route::post('/updateEvenement/{event_id}',[evenementController::class,'update']);


Route::post('/ajouterTache',[tacheController::class,'ajouter']);
Route::post('/terminerTache/{tache_id}',[tacheController::class,'terminer']);
Route::post('/supprimerTache/{tache_id}',[tacheController::class,'supprimer']);
Route::post('/listeTache/{event_id}',[tacheController::class,'afficher']);

Route::post('/listeInvite/{event_id}',[inviteController::class,'afficher']);
Route::post('/ajouterInvite',[inviteController::class,'ajouter']);
Route::post('/supprimerInvite/{id}',[inviteController::class,'supprimer']);
Route::post('/modifierInvite/{id}',[inviteController::class,'modifier']);
Route::post('/updateInvite/{id}',[inviteController::class,'update']);
Route::post('/envoyerEmailInvite/{id}', [InviteController::class, 'envoyerEmail']);

Route::post('/listedepense/{event_id}',[depenceController::class,'afficher']);
Route::post('/ajouterDepense',[depenceController::class,'ajouter']);
Route::post('/supprimerDepense/{id}',[depenceController::class,'supprimer']);
Route::post('/modifierDepense/{id}',[depenceController::class,'modifier']);
Route::post('/updateDepense/{id}',[depenceController::class,'update']);

Route::post('/listeActivite/{event_id}',[activiteController::class,'afficher']);
Route::post('/ajouterActivite',[activiteController::class,'ajouter']);
Route::post('/supprimerActivite/{id}',[activiteController::class,'supprimer']);
Route::post('/modifierActivite/{id}',[activiteController::class,'modifier']);
Route::post('/updateActivite/{id}',[activiteController::class,'update']);

Route::post('/ajouterOffre',[offreController::class,'ajouter']);
Route::post('/detailOffre/{offre_id}',[offreController::class,'detail']);
Route::post('/supprimerOffre/{id}',[offreController::class,'supprimer']);
Route::get('/listeOffre',[offreController::class,'afficherTous']);
Route::post('/rechercheOffre/{value}',[offreController::class,'recherche']);
Route::get('/mesOffres',[offreController::class,'afficher']);
Route::post('/modifierOffre/{id}',[offreController::class,'modifier']);
Route::post('/updateOffre/{id}',[offreController::class,'update']);
Route::post('/rechercheOffrePres/{prestataire_id}',[offreController::class,'recherchePres']);

Route::get('/modifierPrestataire',[prestataireController::class,'modifier']);
Route::post('/updatePrestataire/{id}',[prestataireController::class,'update']);

Route::middleware('auth.token')->group(function () {
    Route::get('/listeEvenement', [evenementController::class, 'afficher']);
});