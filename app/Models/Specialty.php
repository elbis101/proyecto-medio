<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    //una especialidad se asocia con muchos usuarios
    //$Specialty->users
 public function users()
 {
   //withtimestamps sirve para ver la fechas de registro de las especialidades
    return $this->belongsToMany(User::class)->withTimestamps();
 }



}
