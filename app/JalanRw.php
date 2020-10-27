<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JalanRw extends Model
{
    use  SoftDeletes;
    protected $table = "tbl_jalan_rw";

    protected $fillable = ["fk_rw_id", "nama_jalan"];
}
