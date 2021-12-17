<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

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
use App\Models\Image;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CarsController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['index','show', 'bookmarks', 'addBookmark', 'removeBookmark']);
    }


    public function create()
    {
        $brands=Brand::all();
        $colors=Color::all();
        $cities=City::all();
        $engines=Engine::all();
        $fuels=Fuel::all();
        $transmissions=Transmission::all();
        $gearLevers=GearLever::all();
        $carBodies=CarBody::all();
        $equipment=Equipment::all();

        return view('cars.create',[
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


    public function store(StoreCarRequest $request)
    {
        $data = $request->all();

        $car = new Car;
        $car->price=$data['price'];
        $car->currency=$data['currency'];
        $car->made_at=$data['made_at'];
        $car->distance=$data['distance'];
        $car->body=$data['body'];

        $car->credit=array_key_exists('credit',$data);
        $car->barter=array_key_exists('barter',$data);

        $car->transmission_id=$data['transmission'];
        $car->gear_lever_id=$data['gear_lever'];
        $car->city_id=$data['city'];
        $car->car_body_id=$data['car_body'];
        $car->color_id=$data['color'];
        $car->engine_id=$data['engine'];
        $car->horsepower=$data['horsepower'];
        $car->fuel_id=$data['fuel'];
        $car->car_model_id=$data['car_model'];
        $car->user_id=Auth::id();

        if($car->save()){

            if(isset($data['equipment']) && count($data['equipment']) > 0){
                $car->carEquipment()->attach($data['equipment']);
            }

            
            foreach ($data['main_images'] as $key => $image) {

                $fileDirectory = Str::random(7).'_'.time().'.'.$image->extension();
                $url='images/cars'.$car->id.$fileDirectory;

                $carImage=new Image;
                $carImage->url=$url;
                $carImage->type=$key;

                $image->move(public_path('images/cars'.$car->id),$fileDirectory);

                $car->images()->save($carImage);

                // $image->storeAs('public/images/cars/'.$car->id,$url);
            }

            if(isset($data['additional_images']) && count($data['additional_images']) > 0){
                foreach ($data['additional_images'] as $key => $image) {

                    $fileDirectory = Str::random(7).'_'.time().'.'.$image->extension();
                    $url='images/cars'.$car->id.$fileDirectory;
    
                    $carImage=new Image;
                    $carImage->url=$url;
    
                    $image->move(public_path('images/cars'.$car->id),$fileDirectory);
    
                    $car->images()->save($carImage);
    
                }
            }
            
            return redirect()->route('cars.create')->with('success','Maşın əlavə olundu!');

        }
        
        return redirect()->route('cars.create')->with('error','Maşın əlavə olunmadı!');
    }

    public function show($id)
    {
        $car=Car::with(['carModel.brand','images','user','city','carBody','color','engine','fuel','gearLever','transmission','carEquipment'])->findOrFail($id);

        if(Session::has('bookmarks')){
            $oldBookmarks=Session::get('bookmarks');
            $bookmarks=new Bookmark($oldBookmarks);
            $bookmarkedCars=collect($bookmarks->cars);
        } else {
            $bookmarkedCars=[];
        }

        return view('cars.show',[
                'car'=>$car,
                'bookmarkedCars'=>$bookmarkedCars
            ]);
    }

    public function edit(Car $car)
    {
        $this->authorize('update',$car);

        $brands=Brand::all();
        $colors=Color::all();
        $cities=City::all();
        $engines=Engine::all();
        $fuels=Fuel::all();
        $transmissions=Transmission::all();
        $gearLevers=GearLever::all();
        $carBodies=CarBody::all();
        $equipment=Equipment::all();


        $car=Car::with(['carModel.brand.carModels','images','city','carBody','color','engine','fuel','gearLever','transmission','carEquipment'])->findOrFail($car->id);
        return view('cars.edit',[
            'car'=>$car,
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


    public function update(UpdateCarRequest $request, Car $car)
    {
        $this->authorize('update',$car);

        $data = $request->all();

        // dd($data);
        $car->price=$data['price'];
        $car->currency=$data['currency'];
        $car->made_at=$data['made_at'];
        $car->distance=$data['distance'];
        $car->body=$data['body'];

        $car->credit=array_key_exists('credit',$data);
        $car->barter=array_key_exists('barter',$data);

        $car->transmission_id=$data['transmission'];
        $car->gear_lever_id=$data['gear_lever'];
        $car->city_id=$data['city'];
        $car->car_body_id=$data['car_body'];
        $car->color_id=$data['color'];
        $car->engine_id=$data['engine'];
        $car->horsepower=$data['horsepower'];
        $car->fuel_id=$data['fuel'];
        $car->car_model_id=$data['car_model'];

        if($car->save()){

            $car->carEquipment()->detach();

            if(isset($data['equipment']) && count($data['equipment']) > 0){
                $car->carEquipment()->attach($data['equipment']);
            }
            
            return redirect()->route('cars.show',['car'=>$car->id])->with('success','Avtomobiə düzəlişlər edildi!');

        }
        
        return redirect()->route('cars.show',['car'=>$car->id])->with('error','Avtomobiə düzəlişlər edilmədi!');
    }

   
    public function destroy(Car $car)
    {
        $this->authorize('delete',$car);
        
        if($car->delete()){
            File::deleteDirectory(public_path('images/cars/'.$car->id));

            $oldBookmarks=Session::has('bookmarks')?Session::get('bookmarks'):null;
            $bookmarks=new Bookmark($oldBookmarks);
        
            if($bookmarks->remove($car->id)){
                $request->session()->put('bookmarks',$bookmarks);
            }

            return redirect()->route('home')->with('success','Elan uğurla silindi!');
        }
        
        return redirect()->route('cars.show',['car'=>$car->id])->with('error','Elan silinmədi!');
        
    }

    public function addBookmark(Request $request, $id){
        $car=Car::findOrFail($id);
        $oldBookmarks=Session::has('bookmarks')?Session::get('bookmarks'):null;
        $bookmarks=new Bookmark($oldBookmarks);

        if($bookmarks->add($car,$car->id)){
            $request->session()->put('bookmarks',$bookmarks);
            return response('Car - '.$id.' added to bookmarks',200);
        }

        return response('Operation failed!',500);
    }

    public function bookmarks(){
        if(!Session::has('bookmarks')){
            return view('cars.bookmarks',['cars'=>null]);
        } 
        $oldBookmarks=Session::get('bookmarks');
        $bookmarks=new Bookmark($oldBookmarks);
        return view('cars.bookmarks',['cars'=>$bookmarks->cars]);
    }

    public function removeBookmark(Request $request, $id){
        $oldBookmarks=Session::has('bookmarks')?Session::get('bookmarks'):null;
        $bookmarks=new Bookmark($oldBookmarks);
        
        if($bookmarks->remove($id)){
            $request->session()->put('bookmarks',$bookmarks);
            return response('Car - '.$id.' removed from bookmarks',204);
        }
        
        return response('Operation failed!',500);
    }

  
}
