<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class OrderStatus extends Model
{
    use HasFactory;

    //Relación de uno a muchos
    public function orders(){

        return $this->hasMany(Order::class);
    }
}
