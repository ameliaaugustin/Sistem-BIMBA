<?php

namespace App\Models\admin\master_data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterHariModel extends Model
{
    use HasFactory;
    public $table = 'm_hari';
    protected $guarded = ['id'];
}
