<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Collaborator;

class Comission extends Model
{
    use HasFactory;

    //relacion de uno a muchos inversa
    public function collaborator(){

        return $this->belongsTo(Collaborator::class);
    }

}
