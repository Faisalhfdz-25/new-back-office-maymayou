<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryFrozen extends Model
{
    use HasFactory;

    protected $table = 'history_frozen';

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'id_inventory');
    }
}
