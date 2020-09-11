<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use SoftDeletes;

    protected $primaryKey = "tagihan_id";
    protected $table      = "tbl_tagihan";
    protected $fillable   = ['tagihan_id', 'fk_rw_id', 'nama', 'tanggal_tagihan', 'tarif', 'jumlah_tagihan', 'edit_post', 'create_post'];

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'fk_rw_id', 'rw_id');
    }
}
