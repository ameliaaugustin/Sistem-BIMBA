<?php

namespace App\Models\pendaftar\form_pendaftaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormJadwalSiswaModel extends Model
{
    use HasFactory;
    public $table = 'dt_jadwal_siswa';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
