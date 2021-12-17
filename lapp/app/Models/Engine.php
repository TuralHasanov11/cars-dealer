<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    use HasFactory;

    protected $fillable=['volume'];

    public function cars(){
        return $this->hasMany('App\Models\Car');
    }
}
