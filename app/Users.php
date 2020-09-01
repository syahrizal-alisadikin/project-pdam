<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    // use SoftDeletes;

    protected $primaryKey = "id";
    protected $table = "users";
    protected $fillable = ['fk_rw_id', 'name', 'email', 'password'];
    protected $hidden = ['password'];
}
