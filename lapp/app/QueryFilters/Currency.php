<?php

namespace App\QueryFilters;

use Closure;

class Currency
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('currency')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('currency',request('currency'));
        
    }

}