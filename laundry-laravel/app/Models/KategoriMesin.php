<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMesin extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori'];

    public function mesins()
    {
        return $this->hasMany(Mesin::class, 'kategori_id');
    }
}