<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangKeluar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'barang_keluar';

    protected $fillable = [
        'data_barang_id',
        'jumlah',
        'tanggal',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'data_barang_id');
    }

    protected $dates = ['tanggal', 'created_at', 'updated_at', 'deleted_at'];
}
