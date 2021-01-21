<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class Type_identification extends Model
{
    use HasFactory;

    //Relacion de uno a muchos
    public function clients(){
        return $this->hasMany(Client::class);
    }

}
