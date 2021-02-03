<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class Sector extends Model
{
    use HasFactory;
    protected $fillable = ['name','codigo'];
    protected $primaryKey = 'codigo';
    protected $keyType = 'string';

    //Relacion de uno a muchos
    public function orders(){

        return $this->hasMany(Order::class, '' ,'codigo');
    }
}
