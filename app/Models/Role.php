<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    protected $fillable = ['name'];
    public $timestamps = true;
    public function users()
    {
        return $this->hasMany(User::class);
    }
    use HasFactory;
}
