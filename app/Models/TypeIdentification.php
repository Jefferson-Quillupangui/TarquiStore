<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class TypeIdentification extends Model
{
    use HasFactory;

    protected $table='type_identifications';
    public $primaryKey="codigo";
     // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected $fillable = ['codigo','name'];

    //Relacion de uno a muchos
    public function clients(){

        return $this->hasMany(Client::class, '', 'codigo');
        //return $this->hasMany(Client::class);
    }
}