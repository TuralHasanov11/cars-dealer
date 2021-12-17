<?php

namespace App\QueryFilters;

use Closure;

class Transmission
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('transmission') || !array_filter(request('transmission'))){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->whereHas('transmission',function($query){
            $query->whereIn('id', request('transmission'));
        });
        
    }

}