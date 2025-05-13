<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\transaksiDetailModel;

class barangModel extends Model
{
    public $timestamps = true;

    protected $table = 'table_barang';
    protected $fillable = [
        'users_id',
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
    function user_id_barangModel()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
