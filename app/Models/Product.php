<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function Category(){
        $category = Category::find($this->category_id);
	    return $category; 
    }

    //relacion de muchos a muchos 
    public function order(){

        return $this->belongsToMany(Order::class)->using(OrderProduct::class);
    }       
}
