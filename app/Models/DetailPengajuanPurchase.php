<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengajuanPurchase extends Model
{
    use HasFactory;

    protected $table = 'detail_pengajuan_purchase';

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanPurchase::class, 'id_pengajuan');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'id_inventory');
    }
}
