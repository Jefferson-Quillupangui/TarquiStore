<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pivot;
class OrderProduct extends Pivot
{
    use HasFactory;

    protected $table = 'order_product';
    public $incrementing = true;
}