<?php

namespace App\Models;

use App\Models\Resep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';

    protected $fillable = ['nama','foto','resep','kategori','harga','hpp'];

    public function resep(){
        return $this->hasMany(Resep::class, 'id_menu');
    }
}
