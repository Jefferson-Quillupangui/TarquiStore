<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

Use App\Models\Order;

class CitySale extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'name'];
    protected $primaryKey="codigo";
    protected $keyType = 'string';

    //Relacion de uno a muchos
    public function orders(){

        return $this->hasMany(Order::class,'' ,'codigo');
    }
}
