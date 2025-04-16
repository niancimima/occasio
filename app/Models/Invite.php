<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invites';
    protected $primaryKey = 'invite_id';
    public $timestamps = true;

    protected $fillable = [
        'event_id', 'nom' ,'email','invité'
    ];
    public function evenement()
    {
        return $this->belongsTo('App\Models\Evenement','event_id');
    }

    use HasFactory;
}
