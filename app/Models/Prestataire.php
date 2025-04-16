<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
{
    protected $table = 'prestataires';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','type','telephone','adresse','site_web','description'];
    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
