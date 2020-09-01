<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use SoftDeletes;
    protected $primaryKey = "kecamatan_id";
    protected $table = "tbl_kecamatan";
    protected $fillable = ['fk_kota_id', 'name'];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'fk_kota_id', 'kota_id');
    }
}
