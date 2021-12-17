<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Session;
use App\Models\Bookmark;

class UserController extends Controller
{
    public function cars(){
        $cars=Car::with(['carModel.brand','images','user','city','carBody','color','engine','fuel','gearLever','transmission','carEquipment'])
                   ->where('user_id',auth()->id())
                   ->get();
        
        if(Session::has('bookmarks')){
            $oldBookmarks=Session::get('bookmarks');
            $bookmarks=new Bookmark($oldBookmarks);
            $bookmarkedCars=collect($bookmarks->cars);
        } else {
            $bookmarkedCars=[];
        }

        return view('user.cars.index',[
                'cars'=>$cars,
                'bookmarkedCars'=>$bookmarkedCars
            ]);
    }
}
