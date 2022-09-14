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
        'reference_number',
        'payment_mode',
        'credir_period',
        'foctax',
        'invoice_discount',
        'status',
    ];


    protected $guard = [];
}
