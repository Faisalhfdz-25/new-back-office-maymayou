<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPurchase extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_purchase';

    public function details()
    {
        return $this->hasMany(DetailPengajuanPurchase::class, 'id_pengajuan');
    }
}
