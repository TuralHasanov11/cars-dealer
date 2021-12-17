<?php

namespace App\Models;


class Bookmark
{
    public $cars=null;
    
    public function __construct($oldBookmarks){
        if($oldBookmarks){
            $this->cars=$oldBookmarks->cars;
        }
    }

    public function add($car,$id){
        $storedCar=$car;
        if($this->cars){
            if(array_key_exists($id,$this->cars)){
                $storedCar=$this->cars[$id];
            }
        }
        $this->cars[$id]=$storedCar;
        return true;
    }

    public function remove($id){
        if($this->cars){
            if(array_key_exists($id,$this->cars)){
                unset($this->cars[$id]);
                return true;
            }
        }
        return false;
    }
}
