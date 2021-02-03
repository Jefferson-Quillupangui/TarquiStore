<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Order;
use App\Models\TypeIdentification;

class Client extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //Relación de uno a muchos (inversa)
    public function type_Indentification(){
        
        return $this->belongsTo(User::class,'type_identification_cod','codigo');
    }

    public function typeIdentification(){
        
        return $this->belongsTo(TypeIdentification::class,'type_identification_cod','codigo');
    }
    
    //Relacion de uno a muchos
    public function orders(){

        return $this->hasMany(Order::class);
    }
}