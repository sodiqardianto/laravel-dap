<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'nama_barang',
        'harga_barang'
    ];

    public function scopeSearch($query, $keyword)
    {
        return $query->where('nama_barang', 'LIKE', "%$keyword%");
    }
}
