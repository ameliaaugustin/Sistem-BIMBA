<?php

namespace App\Models\admin\master_data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBayarModel extends Model
{
    use HasFactory;
    public $table = 'm_item_bayar';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
