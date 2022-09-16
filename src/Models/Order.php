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
}
