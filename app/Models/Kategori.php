<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi plural
    // protected $table = 'kategoris'; 

    // Tentukan kolom yang boleh diisi (fillable) untuk menghindari mass-assignment vulnerability
    protected $fillable = ['nama'];

    // Jika menggunakan timestamps otomatis, pastikan kolom created_at dan updated_at ada di tabel
    // public $timestamps = false; // Jika tidak menggunakan timestamps
}
