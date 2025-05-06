<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\transaksiDetailModel;

class barangModel extends Model
{
    protected $table = 'table_barang';
    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'harga',
        'kategori',
        'jumlah_barang',
    ];

    function setHargaAttribute($value)
    {
        $value = str_replace(',', '', $value);

        $this->attributes['harga'] = $value;
    }

    function transaksiDetail()
    {
        return $this->hasMany(transaksiDetailModel::class, 'barang_id');
    }
}
