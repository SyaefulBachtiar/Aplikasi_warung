<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\transaksiDetailModel;

class transaksiModel extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'transaksi_items';
    protected $fillable = [
        'users_id',
        'kode_transaksi',
        'total_harga',
        'created_at',
        'updated_at'
    ];

    function totalJumlahBarang()
    {
        return $this->details()->sum('jumlah_barang_satuan');
    }

    function details(): HasMany
    {
        return $this->hasMany(transaksiDetailModel::class, 'transaksi_id');
    }
    function users_id_transaksi()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
