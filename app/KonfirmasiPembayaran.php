<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KonfirmasiPembayaran extends Model
{
    use SoftDeletes;

    protected $primaryKey = "id";
    protected $table = "konfr_pembayaran";
    protected $fillable = ['fk_pembayaran_id', 'fk_rw_id', 'jumlah', 'image'];
}
