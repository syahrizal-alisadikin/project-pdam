<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    // use SoftDeletes;
    use Notifiable;

    protected $primaryKey = "admin_id";
    protected $table = "admins";
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];
}
