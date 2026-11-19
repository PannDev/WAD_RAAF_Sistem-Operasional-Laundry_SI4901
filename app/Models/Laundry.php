<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_layanan', 'kategori', 'nama_layanan', 'harga_reguler', 'harga_express'];
}