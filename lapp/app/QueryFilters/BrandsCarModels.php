<?php

namespace App\QueryFilters;

use Closure;

class BrandsCarModels
{
    
    public function handle($request,Closure $next){

        if((!request()->filled('brand') && !request()->filled('car_model')) || (!array_filter(request('brand')) && !array_filter(request('car_model')))){
            return $next($request);
        }
        $builder = $next($request);

        return $builder->whereHas('carModel.brand',function($query){ 
            if(array_filter(request('car_model'))){
                $query->whereIn('car_models.id',request('car_model'));
            }else{  
               
                $query->whereIn('id',request('brand'));
            }
        });
        
    }

    // protected function applyFilter(){
    //     return $builder->whereHas('carModel.brand',function($query) use ($request){ 
    //         if($request->has('car_model')){
    //             $query->whereIn('car_models.id',$request->car_model);
    //         }else{  
    //             $query->whereIn('id',$request->brand);
    //         }
    //     });
    // }
}
