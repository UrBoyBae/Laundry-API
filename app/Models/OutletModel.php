<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletModel extends Model
{
    use HasFactory;
    protected $table = 'outlets';
    protected $fillable = ['nama','alamat','tlp'];
}
