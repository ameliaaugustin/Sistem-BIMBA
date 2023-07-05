<?php

namespace App\Models\pendaftar\form_pendaftaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAyahModel extends Model
{
    use HasFactory;
    public $table = 'dt_ayah';

    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
