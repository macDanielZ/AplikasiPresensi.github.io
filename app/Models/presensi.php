<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presensi extends Model
{
    protected $fillable = ['id_karyawan','waktu','id_peserta','status'];
    use HasFactory;
}
