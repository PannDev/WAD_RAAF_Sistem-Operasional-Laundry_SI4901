<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;

    protected $fillable = ['kategori_id', 'kode', 'merek', 'kapasitas', 'status'];

    public function kategori()
    {
        return $this->belongsTo(KategoriMesin::class, 'kategori_id');
    }
}