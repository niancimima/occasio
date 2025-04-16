<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $table = 'evenements';
    protected $primaryKey = 'event_id';
    public $timestamps = true;

    protected $fillable = [
        'titre', 'date' ,'heure','lieu','description','user_id','budget'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function taches()
    {
        return $this->hasMany('App\Models\Tache','event_id');
    }
    public function depenses()
    {
        return $this->hasMany('App\Models\Depense','event_id');
    }
    public function invites()
    {
        return $this->hasMany('App\Models\Invite','event_id');
    }
    public function activites()
    {
        return $this->hasMany('App\Models\Activite','event_id');
    }
    use HasFactory;
}
