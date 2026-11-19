<?php

namespace Database\Seeders;

use App\Models\KategoriMesin;
use Illuminate\Database\Seeder;

class KategoriMesinSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = ['Mesin Cuci', 'Mesin Pengering', 'Setrika Uap'];

        foreach ($kategoris as $nama) {
            KategoriMesin::create(['nama_kategori' => $nama]);
        }
    }
}