<?php

namespace App\Models\admin\master_data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDokumenModel extends Model
{
    use HasFactory;

    public $table = 'm_dokumen';

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
