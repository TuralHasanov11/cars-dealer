<?php

namespace App\QueryFilters;

use Closure;

class GearLever
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('gear_lever') || !array_filter(request('gear_lever'))){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->whereHas('gearLever',function($query){ 
            $query->whereIn('id', request('gear_lever'));
        });
        
    }

}