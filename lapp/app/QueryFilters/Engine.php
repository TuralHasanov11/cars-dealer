<?php

namespace App\QueryFilters;

use Closure;

class Engine
{
    
    public function handle($request,Closure $next){

        if(!request()->filled('min_engine') && !request()->filled('max_engine')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->whereHas('engine',function($query){
            if(request()->filled('min_engine') && request()->filled('max_engine')){
                $query->whereBetween('volume', [request('min_engine'), request('max_engine')]);
            }
            elseif(request()->filled('min_engine')){
                $query->where('volume', '>=', request('min_engine'));
            }
            else{
                $query->where('volume', '<=', request('max_engine'));
            }
        });
        
    }

}