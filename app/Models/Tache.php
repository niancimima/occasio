<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'taches';
    protected $primaryKey = 'tache_id';
    public $timestamps = true;

    protected $fillable = [
        'event_id', 'etat' ,'description'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\Evenement','event_id');
    }

    use HasFactory;
}
