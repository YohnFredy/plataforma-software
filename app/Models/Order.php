<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['public_order_number', 'user_id', 'contact', 'phone', 'status', 'envio_type', 'discount', 'shipping_cost', 'total', 'total_pts', 'country_id', 'department_id', 'city_id', 'city', 'address', 'additional_address', 'payment_id'];

   const STATUS_SALE_PENDING = 1; 
   const STATUS_SALE_APPROVED = 2; 
   const STATUS_PTS_GENERATED = 3; 
   const STATUS_SENT = 4; 
   const STATUS_DELIVERED = 5; 
   const STATUS_SALE_REJECTED = 6;  
   const STATUS_VOID_APPROVED  = 7; 
   const STATUS_VOID_REJECTED  = 8; 

    public function getRouteKeyName()
    {
        return 'public_order_number';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Método para actualizar el estado de la orden
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function updateStatusAndPayment($status, $paymentId = null)
    {
        $this->status = $status;
        $this->payment_id = $paymentId;
        
        $this->save();
    }

}
