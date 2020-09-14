<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends Model
{
    // use SoftDeletes;
    protected $primaryKey = "provinsi_id";
    protected $table = "tbl_provinsi";
    protected $fillable = ['name'];
}
