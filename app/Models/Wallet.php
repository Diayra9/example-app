<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'tb_wallet';
    
    protected $primaryKey = 'wallet_id';

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'wallet_id');
    }
}
