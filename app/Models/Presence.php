<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'id_employee',
        'check_in',
        'check_out',
        'date',
        'dstring',
        'attend',
    ];

    public function employee(){
        return $this -> belongsTo('App\Models\Employee', 'id_employee','id');
    }
}
