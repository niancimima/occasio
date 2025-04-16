<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class roleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return $roles;
    }
}
