<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarif extends Model
{
    use SoftDeletes;

    protected $primaryKey = "tarif_id";
    protected $table = "tbl_tarif";
    protected $fillable = ['nama_tarif', 'jumlah_tarif'];
}
