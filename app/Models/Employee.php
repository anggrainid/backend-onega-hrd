<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_user',
        //'name',
        'position',
        'nik',
        'npwp',
        'id_company',
        'started',
        'finished',
    ];

    public function presences(){
        return $this -> hasMany('App\Models\Presence', 'id_employee','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
