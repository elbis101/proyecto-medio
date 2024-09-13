<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{

    public function doctors(Specialty $specialty){
        //devuelve una coleccion le transforma en users
        return $specialty->users()->get(['users.id','users.name']);

    }
    //
}
