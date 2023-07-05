<?php

namespace App\Models\pendaftar\form_pendaftaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranIbuModel extends Model
{
    use HasFactory;

    public $table = 'dt_ibu';

    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
