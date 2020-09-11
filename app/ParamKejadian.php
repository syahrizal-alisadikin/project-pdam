<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParamKejadian extends Model
{
    use SoftDeletes;
    protected $primaryKey = "param_id";
    protected $table = "tbl_param_kejadian";
    protected $fillable = ['nama'];
}
