<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kota extends Model
{
    use SoftDeletes;
    protected $primaryKey = "kota_id";
    protected $table = "tbl_kota";
    protected $fillable = ['fk_provinsi_id', 'name'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'fk_provinsi_id', 'provinsi_id');
    }
}
