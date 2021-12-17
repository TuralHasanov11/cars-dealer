<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function cars(){
        $cars = Car::with(['user','carModel.brand'])
                    ->paginate(20);

        return view('admin.cars.index',['cars'=>$cars]);
    }

    public function showCar(Car $car){
        $car->load(['carModel.brand','images','user','city','carBody','color','engine','fuel','gearLever','transmission','carEquipment']);

        return view('admin.cars.show',['car'=>$car]);
    }

    public function destroyCar(Car $car)
    {
        
        if($car->delete()){

            File::deleteDirectory(public_path('images/cars/'.$car->id));

            return redirect()->route('admin.cars')->with('success','Elan uğurla silindi!');
        }
        return redirect()->route('admin.cars')->with('error','Elan silinmədi!');  
    }

    public function users(){
        $users = User::withCount('cars')->paginate(10);

        return view('admin.users.index',['users'=>$users]);
    }

    public function showUser(User $user){
        $user->load('cars.carModel.brand');
        return view('admin.users.show', ['user'=>$user]);
    }

    public function destroyUser(User $user)
    {   
        if($user->delete()){
            return redirect()->route('admin.users')->with('success','istifadəçi silindi!');
        }
        return redirect()->route('admin.showUser',['user'=>$user])->with('error','istifadəçi silinmədi!');  
    }
}
