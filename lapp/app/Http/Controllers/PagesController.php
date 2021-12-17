<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use Session;
use App\Models\Bookmark;

class PagesController extends Controller
{
    public function index(){

        $brands=Brand::all();
        $cars=Car::with(['city','engine','images'=>function($query){
            $query->where('type', 'front');
        },'carModel.brand'])->paginate(20);

        if(Session::has('bookmarks')){
            $oldBookmarks=Session::get('bookmarks');
            $bookmarks=new Bookmark($oldBookmarks);
            $bookmarkedCars=collect($bookmarks->cars);
        } else {
            $bookmarkedCars=[];
        }
        
        return view('welcome',[
            'cars'=>$cars,
            'brands'=>$brands,
            'bookmarkedCars'=>$bookmarkedCars
        ]);
    }

  
}
