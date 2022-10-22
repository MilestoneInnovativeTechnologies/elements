<?php

namespace Milestone\Elements\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable=[
        'id',
        'order_date',
        'sales_executive',
        'customer',
        'reference_number',
        'payment_mode',
        'credit_period',
        'foctax',
        'invoice_discount',
        'status',
    ];


    protected $guard = [];

    public function getTotalPrice() {
        return $this->buyDetails()->sum(DB::raw('quantity * price'));
    }

    public function rsalesexecutive(){
        return $this->belongsTo(User::class, 'sales_executive');
    }

    public function rcustomer(){
        return $this->belongsTo(Customers::class, 'customer');
    }

    public function Items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
