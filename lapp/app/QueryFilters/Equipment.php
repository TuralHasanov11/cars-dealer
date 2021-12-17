<?php

namespace App\QueryFilters;

use Closure;

class Equipment
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('equipment') || !array_filter(request('equipment'))){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->whereHas('carEquipment',function($query){
            $query->whereIn('car_equipment.equipment_id',request('equipment'));
        });
        
    }

}