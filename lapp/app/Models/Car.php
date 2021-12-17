<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Pipeline\Pipeline;

class Car extends Model
{
    use HasFactory;

    protected $guarded=['price','made_at','views','distance',
                        'barter','credit','body', 'currency', 'horsepower',
                        'user_id','city_id','car_body_id','color_id','engine_id',
                        'fuel_id','car_model_id','transmission_id','gear_lever_id'
                    ];
       
    public function createdDateTime(){
        $date = Carbon::parse($this->created_at);
        return $date->format('d.m.Y H:i');
    }

    public function updatedDateTime(){
        $date = Carbon::parse($this->updated_at);
        return $date->format('d.m.Y H:i');
    }

    public function engineVolume(){
        return number_format($this->engine()->first()->volume/1000, 1);
    }
    // Relationships

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function city(){
        return $this->belongsTo('App\Models\City');
    }
    public function carBody(){
        return $this->belongsTo('App\Models\CarBody');
    }
    public function color(){
        return $this->belongsTo('App\Models\Color');
    }
    public function engine(){
        return $this->belongsTo('App\Models\Engine');
    }
    public function fuel(){
        return $this->belongsTo('App\Models\Fuel');
    }
    public function transmission(){
        return $this->belongsTo('App\Models\Transmission');
    }
    public function gearLever(){
        return $this->belongsTo('App\Models\GearLever');
    }
    public function carModel(){
        return $this->belongsTo('App\Models\CarModel');
    }

    public function images(){
        return $this->hasMany('App\Models\Image');
    }

    public function carEquipment(){
        return $this->belongsToMany('App\Models\Equipment','car_equipment')->as('car_equipment')->withTimestamps();
    }

    // Static Methods
    public static function currencies(){
        return ['AZN','USD','EUR'];
    }

    public static function orderMethods(){
        return [
                    'date'=>['created_at','desc'],
                    'price_cheap'=>['price','asc'],
                    'price_expensive'=>['price','desc'],
                    'distance'=>['distance','desc'],
                    'made_at'=>['made_at','desc']
        ];
    }

    public static function searchCars(){
         
        return $cars = app(Pipeline::class)
            ->send(Car::query()->with(['images'=>function($query){
                $query->where('type', 'front');
            },'engine','city', 'color', 'carModel.brand', 'fuel', 'carBody', 'carEquipment', 'gearLever', 'transmission']))
            ->through([
                \App\QueryFilters\BrandsCarModels::class,
                \App\QueryFilters\Price::class,
                \App\QueryFilters\Distance::class,
                \App\QueryFilters\MadeAt::class,
                \App\QueryFilters\Barter::class,
                \App\QueryFilters\Credit::class,
                \App\QueryFilters\Engine::class,
                \App\QueryFilters\Fuel::class,
                \App\QueryFilters\Color::class,
                \App\QueryFilters\City::class,
                \App\QueryFilters\CarBody::class,
                \App\QueryFilters\Equipment::class,
                \App\QueryFilters\GearLever::class,
                \App\QueryFilters\MadeAt::class,
                \App\QueryFilters\Transmission::class,
                \App\QueryFilters\Currency::class,
            ])
            ->thenReturn();
    }
}
