<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataBarang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'data_barang';

    protected $fillable = [
        'kode_barang', 'nama_barang', 'harga', 'stok',
        'created_by', 'updated_by', 'deleted_by'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
