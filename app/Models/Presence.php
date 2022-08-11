<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_user',
        'check_in',
        'check_out',
        'date',
        'dstring',
        'attend',
    ];

    public function user(){
        return $this -> belongsTo('App\Models\User', 'id_user','id');
    }
}
