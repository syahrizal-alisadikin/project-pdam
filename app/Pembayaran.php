<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran extends Model
{
    use SoftDeletes;

    protected $primaryKey = "pembayaran_id";
    protected $table = "tbl_pembayaran";
    protected $fillable = ['pembayaran_id', 'fk_tagihan_id', 'tanggal_pembayaran', 'jumlah_bayar', 'status', 'edit_post', 'create_post'];
}
