<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warga extends Model
{
    // use SoftDeletes;
    protected $primaryKey = "warga_id";
    protected $table = "tbl_warga";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fk_rw_id', 'nama', 'email', 'password', 'phone', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'user_id', 'foto_ktp', 'foto_profile', 'foto_kk', 'longtitude', 'latitude', 'edit_post', 'status', 'id_rt', 'gol_darah', 'profesi'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'fk_rw_id', 'rw_id');
    }
}
