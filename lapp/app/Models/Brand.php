<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    
    public function carModels(){
        return $this->hasMany('App\Models\CarModel');
    }

    public function cars()
    {
        return $this->hasManyThrough('App\Models\Car', 'App\Models\CarModel');
    }
}
