<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable=['url','type','car_id'];

    public function car(){
        return $this->belongsTo('App\Models\Car');
    }
}
