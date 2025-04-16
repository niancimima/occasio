<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    protected $table = 'activites';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nom', 'event_id' ,'heure_debut','heure_fin','description',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\Evenement','event_id');
    }

    use HasFactory;
}
