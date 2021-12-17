<?php

namespace App\QueryFilters;

use Closure;

class Distance
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('min_distance') && !request()->filled('max_distance')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where(function($query){
            if(request()->filled('min_distance') && request()->filled('max_distance')){
                $query->whereBetween('distance', [request('min_distance'), request('max_distance')]);
            } elseif (request()->filled('min_distance')) {
                $query->where('distance','>=', request('min_distance'));
            } elseif (request()->filled('max_distance')) {
                $query->where('distance','<=', request('max_distance'));
            }
        });
        
    }

}