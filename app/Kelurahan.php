<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    // use SoftDeletes;
    protected $primaryKey = "kelurahan_id";
    protected $table = "tbl_kelurahan";
    protected $fillable = ['fk_kecamatan_id', 'name'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'fk_kecamatan_id', 'kecamatan_id');
    }
}
