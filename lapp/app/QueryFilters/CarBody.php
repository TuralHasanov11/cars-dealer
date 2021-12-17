<?php

namespace App\QueryFilters;

use Closure;

class CarBody
{
    
    public function handle($request,Closure $next){
        if(!request()->filled('car_body') || !array_filter(request('car_body'))){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->whereHas('carBody',function($query){
            $query->whereIn('id',request('car_body'));
        });
        
    }

}