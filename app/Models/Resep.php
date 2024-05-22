<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory', 'id_inventory', 'id');
    }
}
