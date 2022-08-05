<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'role',
        'nik',
        'npwp',
        'id_company',
        'started',
        'finished',
    ];

    public function presences(){
        return $this -> hasMany('App\Models\Presence', 'id_employee','id');
    }
}
