<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangMasuk extends Model
{
    use SoftDeletes;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'data_barang_id',
        'jumlah',
        'tanggal',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'data_barang_id');
    }
}
