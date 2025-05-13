<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tableBelanjaModel extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'table_transaksi_detail';
    protected $fillable = [
        'users_id',
        'jenis_belanja',
        'total_belanja',
        'created_at',
        'update_at'
    ];

    function user_id_belanja()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
