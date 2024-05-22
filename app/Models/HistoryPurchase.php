<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPurchase extends Model
{
    use HasFactory;

    protected $table = 'history_purchase';

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'id_inventory');
    }
}
