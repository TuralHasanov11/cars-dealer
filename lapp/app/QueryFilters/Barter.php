<?php

namespace App\QueryFilters;

use Closure;

class Barter
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('barter')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('barter',true);
        
    }

}