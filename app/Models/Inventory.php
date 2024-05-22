<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function jeniskategori()
    {
        return $this->belongsTo('App\Models\JenisKategori', 'jenis', 'id');
    }

    public function penggunaanproduk()
    {
        return $this->belongsTo('App\Models\PenggunaanProduk', 'penggunaan', 'id');
    }

    public function kelasproduk()
    {
        return $this->belongsTo('App\Models\KelasProduk', 'kelas', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'tempat', 'id');
    }

    
    
}
