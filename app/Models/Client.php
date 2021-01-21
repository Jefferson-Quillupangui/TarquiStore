<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Order;

class Client extends Model
{
    use HasFactory;

    //Relación de uno a muchos (inversa)
    public function type_Indentification(){
        
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos
    public function orders(){

        return $this->hasMany(Order::class);
    }
}
