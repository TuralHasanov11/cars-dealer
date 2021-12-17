<?php

namespace App\QueryFilters;

use Closure;

class MadeAt
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('min_made_at') && !request()->filled('max_made_at')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where(function($query){
            if(request()->filled('min_made_at') && request()->filled('max_made_at')){
                $query->whereBetween('made_at', [request('min_made_at'), request('max_made_at')]);
            } elseif (request()->filled('min_made_at')) {
                $query->where('made_at','>=', request('min_made_at'));
            } elseif (request()->filled('max_made_at')) {
                $query->where('made_at','<=', request('max_made_at'));
            }
        });
        
    }

}