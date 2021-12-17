<?php

namespace App\QueryFilters;

use Closure;

class Color
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('color') || !array_filter(request('color'))){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->whereHas('color',function($query){
            $query->whereIn('id',request('color'));
        });
        
    }

}