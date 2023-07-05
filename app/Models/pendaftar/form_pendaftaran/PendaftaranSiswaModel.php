<?php

namespace App\Models\pendaftar\form_pendaftaran;

use App\Models\admin\master_data\MasterAgamaModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranSiswaModel extends Model
{
    use HasFactory;

    public $table = 'dt_pendaftar';

    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
