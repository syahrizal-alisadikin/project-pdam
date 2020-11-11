<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanPb extends Model
{
    protected $table = "tbl_laporan_pb";
    protected $primaryKey = "id";
    protected $fillable = ['nama', 'longtitude', 'latitude', 'alamat', 'fk_pb_id'];
}
