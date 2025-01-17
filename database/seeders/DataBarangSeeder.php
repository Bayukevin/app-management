<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataBarang;

class DataBarangSeeder extends Seeder
{
    public function run()
    {
        DataBarang::create([
            'kode_barang' => 'EL12345',
            'nama_barang' => 'Televisi 40 inch',
            'harga' => 4000000,
            'stok' => 10,
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null
        ]);

        DataBarang::create([
            'kode_barang' => 'EL12346',
            'nama_barang' => 'Kulkas 2 Pintu',
            'harga' => 5000000,
            'stok' => 5,
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null
        ]);

        DataBarang::create([
            'kode_barang' => 'EL12347',
            'nama_barang' => 'Mesin Cuci 7kg',
            'harga' => 2500000,
            'stok' => 15,
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null
        ]);

        DataBarang::create([
            'kode_barang' => 'EL12348',
            'nama_barang' => 'AC 1 PK',
            'harga' => 3200000,
            'stok' => 7,
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null
        ]);

        DataBarang::create([
            'kode_barang' => 'EL12349',
            'nama_barang' => 'Rice Cooker 1L',
            'harga' => 500000,
            'stok' => 20,
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null
        ]);
    }
}
