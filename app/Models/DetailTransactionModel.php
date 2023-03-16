<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransactionModel extends Model
{
    use HasFactory;
    protected $table = 'transactions_details';
    protected $fillable = ['id_transaksi','id_paket','qty','keterangan'];

    /**
     * Get the user that owns the DetailTransactionModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(TransactionModel::class, 'id_transaksi', 'id');
    }

    /**
     * Get the user that owns the DetailTransactionModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(PackageModel::class, 'id_paket', 'id');
    }
}
