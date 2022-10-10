<?php

namespace Milestone\Elements\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable=[
        'id',
        'order_id',
        'item',
        'rate',
        'quantity',
        'discount',
        'foc_quantity',
        'foc_tax',
        'invoice_discount',
        'tax_rule',
        'tax_percentage',
        'factor',
        'status',

    ];


    protected $guard = [];

    public function ritem(){
        return $this->belongsTo(Item::class, 'item');
    }
}
