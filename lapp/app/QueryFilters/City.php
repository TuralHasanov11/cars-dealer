<?php

namespace App\QueryFilters;

use Closure;

class City
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('city') || !array_filter(request('city'))){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->whereHas('city',function($query){
            $query->whereIn('id',request('city'));
        });
        
    }

}