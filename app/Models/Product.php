<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Order;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];  

    public function Category(){
        /*$category = Category::find($this->category_id);
        return $category;*/
        
        return $this->belongsTo(Category::class);
    }

    //relacion de muchos a muchos 
    public function order(){

        return $this->belongsToMany(Order::class)->using(OrderProduct::class);
    }       
}
