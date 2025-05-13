<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\barangModel;

class transaksiDetailModel extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'table_transaksi_detail';
    protected $fillable = [
        'users_id',
        'transaksi_id',
        'barang_id',
        'jumlah_barang_satuan',
        'harga_satuan',
        'total_harga',
        'created_at',
        'updated_at'
    ];

    function barang() : BelongsTo
    {
        return $this->belongsTo(barangModel::class, 'barang_id');
    }
    function transaksi() : BelongsTo
    {
        return $this->belongsTo(transaksiModel::class, 'transaksi_id');
    }
    function users_id_detail_transaksi()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

}
