<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $table = 'depenses';
    protected $primaryKey = 'depense_id';
    public $timestamps = true;

    protected $fillable = [
        'event_id', 'montant' ,'description','date'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\Evenement','event_id');
    }

    use HasFactory;
}
