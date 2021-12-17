<?php

namespace App\QueryFilters;

use Closure;

class Price
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('min_price') && !request()->filled('max_price')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where(function($query){
            if(request()->filled('min_price') && request()->filled('max_price')){
                $query->whereBetween('price', [request('min_price'), request('max_price')]);
            } elseif (request()->filled('min_price')) {
                $query->where('price','>=', request('min_price'));
            } elseif (request()->filled('max_price')) {
                $query->where('price','<=', request('max_price'));
            }
        });
        
    }
}
