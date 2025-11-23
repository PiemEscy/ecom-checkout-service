<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $connection;
    public function __construct() { $this->connection = config('database.default'); } 
    protected $table= 'checkouts';

    protected $fillable = [
        'user_id', 'total_price', 'status', 'order_date'
    ];
}
