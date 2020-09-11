<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanKejadian extends Model
{
    // use SoftDeletes;
    protected $primaryKey = "kejadian_id";
    protected $table = "tbl_kejadian";
    protected $fillable = ['fk_user_id', 'fk_rw_id', 'fk_param_id', 'tanggal_kejadian', 'keterangan', 'edit_post', 'create_post', 'deleted_at'];
    

    public function ParamKejadian()
    {
    	return $this->belongsTo(ParamKejadian::class, "fk_param_id", "param_id");
    }

}

