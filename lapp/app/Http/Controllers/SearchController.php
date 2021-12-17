<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Session;
use App\Http\Requests\CarSearchRequest;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Engine;
use App\Models\City;
use App\Models\Fuel;
use App\Models\Transmission;
use App\Models\GearLever;
use App\Models\CarBody;
use App\Models\Equipment;
use App\Models\Bookmark;

class SearchController extends Controller
{
    public function index(CarSearchRequest $request){

        $cars = Car::searchCars()->paginate(20);

        // $data = $request->all()['search'];

        // if(Arr::exists($data,'min_price')){
        //     $minPrice=$data['min_price'];
        // }else{
        //     $minPrice=null;
        // }

        // if(Arr::exists($data,'max_price')){
        //     $maxPrice=$data['max_price'];
        // }else{
        //     $maxPrice=null;
        // }

        // if(Arr::exists($data,'currency')){
        //     $currency=$data['currency'];
        // }else{
        //     $currency=null;
        // }

        // if(Arr::exists($data,'min_distance')){
        //     $minDistance=intval($data['min_distance']);
        // }else{
        //     $minDistance=null;
        // }

        // if(Arr::exists($data,'max_distance')){
        //     $maxDistance=intval($data['max_distance']);
        // }else{
        //     $maxDistance=null;
        // }

        
        // if(Arr::exists($data,'min_made_at')){
        //     $minMadeAt=$data['min_made_at'];
        // }else{
        //     $minMadeAt=null;
        // }

        // if(Arr::exists($data,'max_made_at')){
        //     $maxMadeAt=$data['max_made_at'];
        // }else{
        //     $maxMadeAt=null;
        // }


        // // Relationed
        // if(Arr::exists($data,'brand') && Arr::accessible($data['brand'])){
        //     $brands=$data['brand'];
        // }else{
        //     $brands=null;
        // }

        // if(Arr::exists($data,'car_model') && Arr::accessible($data['car_model'])){
        //     $carModels=$data['car_model'];
        // }else{
        //     $carModels=null;
        // }

        // if(Arr::exists($data,'car_body') && Arr::accessible($data['car_body'])){
        //     $carBodies=$data['car_body'];
        // }else{
        //     $carBodies=null;
        // }

        // if(Arr::exists($data,'color') && Arr::accessible($data['color'])){
        //     $colors=$data['color'];
        // }else{
        //     $colors=null;
        // }

        // if(Arr::exists($data,'city') && Arr::accessible($data['city'])){
        //     $cities=$data['city'];
        // }else{
        //     $cities=null;
        // }

        // if(Arr::exists($data,'fuel') && Arr::accessible($data['fuel'])){
        //     $fuels=$data['fuel'];
        // }else{
        //     $fuels=null;
        // }

        // if(Arr::exists($data,'transmission') && Arr::accessible($data['transmission'])){
        //     $transmissions=$data['transmission'];
        // }else{
        //     $transmissions=null;
        // }

        // if(Arr::exists($data,'gear_lever') && Arr::accessible($data['gear_lever'])){
        //     $gearLevers=$data['gear_lever'];
        // }else{
        //     $gearLevers=null;
        // }

        // if(Arr::exists($data,'min_engine')){
        //     $minEngine=$data['min_engine'];
        // }else{
        //     $minEngine=null;
        // }

        // if(Arr::exists($data,'max_engine')){
        //     $maxEngine=$data['max_engine'];
        // }else{
        //     $maxEngine=null;
        // }

        // if(Arr::exists($data,'equipment') && Arr::accessible($data['equipment'])){
        //     $equipment=$data['equipment'];
        // }else{
        //     $equipment=null;
        // }
        
        // // Sort
        // if(Arr::exists($data,'sort_by') && Arr::exists(Car::orderMethods(),$data['sort_by'])){
        //     $sortBy=$sortMethods[$data['sort_by']];
        // }else{
        //     $sortBy=['created_at','desc'];
        // }

        // // dd($data);

        // $cars=Car::with(['carModel.brand','images','user','city','carBody','color','engine','fuel','gearLever','transmission','carEquipment'])
        //                 ->where(function ($query) use ($data){
        //                     $query->where('barter',Arr::exists($data,'barter'))->where('credit',Arr::exists($data,'credit'))
        //                     ->orWhere('barter',!Arr::exists($data,'barter'))->orWhere('credit',!Arr::exists($data,'credit'));
        //                 })
        //                 ->where(function($query) use($currency){
        //                     if($currency){
        //                         $query->where('currency',$currency);
        //                     }
        //                 })
        //                 ->where(function($query) use ($minPrice,$maxPrice){ // Price
        //                     if($minPrice && $maxPrice){
        //                         $query->whereBetween('price', [$minPrice,$maxPrice]);
        //                     } elseif ($minPrice) {
        //                         $query->where('price','>=', $minPrice);
        //                     } elseif ($maxPrice) {
        //                         $query->where('price','<=', $maxPrice);
        //                     }
        //                 })
        //                 ->where(function($query) use ($minMadeAt,$maxMadeAt){ // Made At Year
        //                     if($minMadeAt && $maxMadeAt){
        //                         $query->whereBetween('made_at', [$minMadeAt,$maxMadeAt]);
        //                     } elseif ($minMadeAt) {
        //                         $query->where('made_at','>=', $minMadeAt);
        //                     } elseif ($maxMadeAt) {
        //                         $query->where('made_at','<=', $maxMadeAt);
        //                     }
        //                 })
        //                 ->where(function($query) use ($minDistance,$maxDistance){ // Distance
        //                     if($minDistance && $maxDistance){
        //                         $query->whereBetween('distance', [$minDistance,$maxDistance]);
        //                     } elseif ($minDistance) {
        //                         $query->where('distance','>=', $minDistance);
        //                     } elseif ($maxDistance) {
        //                         $query->where('distance','<=', $maxDistance);
        //                     }
        //                 })
        //                 ->whereHas('carModel.brand',function(Builder $query) use ($carModels,$brands){ // Brand and Model 
        //                     if($carModels){
        //                         $query->whereIn('car_models.id',$carModels);
        //                     } elseif($brands){  
        //                         $query->whereIn('id',$brands);
        //                     }
        //                 })
        //                 ->whereHas('carBody',function(Builder $query) use ($carBodies){ // Car body type
        //                     if($carBodies){
        //                         $query->whereIn('id',$carBodies);
        //                     }
        //                 })
        //                 ->whereHas('color',function(Builder $query) use ($colors){ // Color
        //                     if($colors){
        //                         $query->whereIn('id',$colors);
        //                     }
        //                 })
        //                 ->whereHas('city',function(Builder $query) use ($cities){ // City
        //                     if($cities){
        //                         $query->whereIn('id',$cities);
        //                     }
        //                 })
        //                 ->whereHas('fuel',function(Builder $query) use ($fuels){ // City
        //                     if($fuels){
        //                         $query->whereIn('id',$fuels);
        //                     }
        //                 })
        //                 ->whereHas('transmission',function(Builder $query) use ($transmissions){ // City
        //                     if($transmissions){
        //                         $query->whereIn('id',$transmissions);
        //                     }
        //                 })
        //                 ->whereHas('gearLever',function(Builder $query) use ($gearLevers){ // City
        //                     if($gearLevers){
        //                         $query->whereIn('id',$gearLevers);
        //                     }
        //                 })
        //                 ->whereHas('engine',function(Builder $query) use ($minEngine,$maxEngine){ // Engine
        //                     if($minEngine && $maxEngine){
        //                         $query->whereBetween('volume', [$minEngine,$maxEngine]);
        //                     } elseif ($minEngine) {
        //                         $query->where('volume','>=', $minEngine);
        //                     } elseif ($maxEngine) {
        //                         $query->where('volume','<=', $maxEngine);
        //                     }
        //                 })
        //                 ->whereHas('carEquipment',function(Builder $query) use ($equipment){ // Equipment
        //                     if($equipment){
        //                         $query->whereIn('car_equipment.equipment_id',$equipment);
        //                     }
        //                 })
        //                 ->orderBy($sortBy[0],$sortBy[1])
        //                 ->paginate(20);
        
        $brands=Brand::all();
        
        if(Session::has('bookmarks')){
            $oldBookmarks=Session::get('bookmarks');
            $bookmarks=new Bookmark($oldBookmarks);
            $bookmarkedCars=collect($bookmarks->cars);
        } else {
            $bookmarkedCars=[];
        }
        return view('search.index',[
                'cars'=>$cars,
                'brands'=>$brands,
                'bookmarkedCars'=>$bookmarkedCars,
            ]);
     }

    public function detailed(){
        $brands=Brand::all();
        $colors=Color::all();
        $cities=City::all();
        $engines=Engine::all();
        $fuels=Fuel::all();
        $transmissions=Transmission::all();
        $gearLevers=GearLever::all();
        $carBodies=CarBody::all();
        $equipment=Equipment::all();

        return view('search.detailed',[
            'colors'=>$colors,
            'brands'=>$brands,
            'engines'=>$engines,
            'fuels'=>$fuels,
            'transmissions'=>$transmissions,
            'gearLevers'=>$gearLevers,
            'equipment'=>$equipment,
            'carBodies'=>$carBodies,
            'cities'=>$cities
        ]);
    } 
}
