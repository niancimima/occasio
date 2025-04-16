<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $table = 'offres';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'titre', 'description' ,'prix','prestataire_id','image_url'
    ];
    public function prestataire()
    {
        return $this->belongsTo('App\Models\Prestataire','prestataire_id');
    }

    use HasFactory;
}
