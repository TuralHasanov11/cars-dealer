<?php

namespace App\QueryFilters;

use Closure;

class Fuel
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('fuel') || !array_filter(request('fuel'))){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->whereHas('fuel', function($query){
            $query->whereIn('id', request('fuel'));
        });
        
    }

}