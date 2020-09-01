<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rw extends Authenticatable
{
    use SoftDeletes;

    protected $primaryKey = "rw_id";
    protected $table = "tbl_rw";
    protected $fillable = ['rw_id', 'name', 'email', 'password', 'alamat', 'fk_kelurahan_id', 'fk_kecamatan_id', 'fk_kota_id', 'fk_provinsi_id'];
    protected $hidden = ['password'];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'fk_kelurahan_id', 'kelurahan_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'fk_kecamatan_id', 'kecamatan_id');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'fk_kota_id', 'kota_id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'fk_provinsi_id', 'provinsi_id');
    }

    public function rw()
    {
        return $this->hashMany(Warga::class);
    }
}
