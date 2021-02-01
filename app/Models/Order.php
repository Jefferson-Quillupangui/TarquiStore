<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Sector;
use App\Models\Client;
use App\Models\Collaborator;
use App\Models\Product;
use App\Models\OrderStatus;

class Order extends Model
{
    use HasFactory;

    //relacion de uno a muchos inversa
    public function sector(){

        return $this->belongsTo(Sector::class,'sector_cod' ,'codigo');
    }

    //relacion de uno a muchos inversa
    public function citySale(){

        return $this->belongsTo(CitySale::class,'city_sale_cod','codigo');
    }

    //relacion de uno a muchos inversa
    public function orderStatus(){

        return $this->belongsTo(OrderStatus::class,'order_status_cod','codigo');
    }
    

    //relacion de uno a muchos inversa
    public function client(){

        return $this->belongsTo(Client::class);
    }   

    //relacion de uno a muchos inversa
    public function collaborator(){

        return $this->belongsTo(Collaborator::class);
    }    
    
    //relacion de muchos a muchos 
    public function product(){

        return $this->belongsToMany(product::class)->using(OrderProduct::class);
    } 
    
}
