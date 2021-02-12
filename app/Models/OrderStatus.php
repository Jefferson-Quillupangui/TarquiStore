<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_statuses';
    protected $fillable = ['codigo','name','description'];
    protected $primaryKey="codigo";
    protected $keyType = 'string';

    // /**atributos de la tabla ordes
    //  */

    // private $id;
    // private $delivery_date;
    // private $delivery_time;
    // private $delivery_address;
    // private $total_order;
    // private $total_comission;
    // private $observation;
    // private $status_comission;
    // private $sector_cod;
    // private $city_sale_cod;
    // private $client_id;
    // private $collaborator_id;
    // private $order_status_cod;
    // private $created_at;
    // private $updated_at;



    //Relación de uno a muchos
    public function orders(){

        return $this->hasMany(Order::class,'' ,'codigo');
    }

    



}