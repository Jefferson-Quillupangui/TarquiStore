<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Comission;
use App\Models\Order;

class Collaborator extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    //relacion de uno a uno inversa
    public function user_collaborator(){

        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos
    public function comissions(){

        return $this->hasMany(Comission::class);
    }

    //Relacion de uno a muchos
    public function orders(){

        return $this->hasMany(Order::class);
    }


}
