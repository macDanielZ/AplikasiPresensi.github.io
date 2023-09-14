<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
    protected $fillable = ['nama_peserta','id_kelas'];
    protected $primaryKey = 'id_peserta';
    use HasFactory;
}
