<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageModel extends Model
{
    use HasFactory;
    protected $table = 'package';
    protected $fillable = ['id_outlet','jenis','nama_paket','harga'];

    /**
     * Get the user that owns the PackageModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function outlet(): BelongsTo
    {
        return $this->belongsTo(OutletModel::class, 'id_outlet', 'id');
    }
}
