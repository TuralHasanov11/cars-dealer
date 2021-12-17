<?php

namespace App\QueryFilters;

use Closure;

class Credit
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('credit')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('credit',true);
        
    }

}