<?php

namespace App\Models\admin\master_data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJamPelajaranModel extends Model
{
    use HasFactory;
    public $table = 'dt_jam_pelajaran';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
