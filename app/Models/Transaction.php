<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'tb_transaction';
    
    protected $primaryKey = 'transaction_id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }
}
