<?php

namespace App\Models\admin\master_data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPekerjaanModel extends Model
{
    use HasFactory;

    public $table = 'm_pekerjaan';
    protected $guarded = ['id'];
}
