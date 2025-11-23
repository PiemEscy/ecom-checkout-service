<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutItem extends Model
{
    use HasFactory;

    protected $connection;
    public function __construct() { $this->connection = config('database.default'); } 
    protected $table= 'checkout_items';

    protected $fillable = [
        'checkout_id', 'product_id', 'quantity', 'price_at_checkout'
    ];
}
