<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['nama','username','password','id_outlet','role'];

    /**
     * Get the user that owns the UserModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function outlet(): BelongsTo
    {
        return $this->belongsTo(OutletModel::class, 'id_outlet', 'id');
    }
}
