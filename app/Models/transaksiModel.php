<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\transaksiDetailModel;

class transaksiModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi_items';
    protected $fillable = [
        'kode_transaksi',
        'total_harga'
    ];

    public function details(): HasMany
    {
        return $this->hasMany(transaksiDetailModel::class, 'transaksi_id');
    }
}
