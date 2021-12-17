<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;


class UpdateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'nullable|string',
            'price'=>'required|numeric|min:500',
            'brand'=>'required|integer|exists:brands,id',
            'car_model'=>'required|integer|exists:car_models,id',
            'car_body'=>'required|integer|exists:car_bodies,id',
            'distance'=>'required|numeric',
            'gear_lever'=>'required|integer|exists:gear_levers,id',
            'transmission'=>'required|integer|exists:transmissions,id',
            'fuel'=>'required|integer|exists:fuels,id',
            'made_at'=>'required|integer|between:2000,'.Carbon::now()->year,
            'engine'=>'required|integer|exists:engines,id',
            'horsepower'=>'required|integer|between:0,500', // get min and max 
            'color'=>'required|integer|exists:colors,id',
            'city'=>'required|integer|exists:cities,id',
            'equipment'=>'nullable|array',
            'equipment.*'=>'exists:equipment,id',
        ];
    }
}
