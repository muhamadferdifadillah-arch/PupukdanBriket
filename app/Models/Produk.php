<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'products'; // ✅ SESUAIKAN NAMA TABEL

    protected $fillable = [
        'produsen_id',
        'nama_produk',
        'harga',
        'stok',
        'status',
    ];

     public function produsen()
    {
        return $this->belongsTo(User::class, 'produsen_id');
    }
}
