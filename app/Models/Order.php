<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['customer_name', 'customer_contact', 'customer_email', 'billing_address', 'billing_city', 'shipping_address', 'shipping_city', 'order_date', 'sub_total', 'discount', 'grand_total', 'delivery_date', 'order_status', 'cart_details'];

    public $timestamps = false;
}
