<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transaction";

    protected $fillable = [
        'user_id',
        'product_id',
        'meja_id',
        'transaction_id',
        'buy_price',
        'method',
        'quantity',
        'total_price',
        'buy_date',
        'customer_name',
        'status',
        'product_name',
    ];

    protected $perPage = 10;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }


}
