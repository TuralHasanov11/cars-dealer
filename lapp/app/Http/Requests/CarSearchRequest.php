<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Car;

class CarSearchRequest extends FormRequest
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
            'search.min_price'=>'nullable|integer',
            'search.max_price'=>'nullable|integer',
            'search.min_distance'=>'nullable|numeric',
            'search.max_distance'=>'nullable|numeric',
            'search.min_made_at'=>'nullable|integer',
            'search.max_made_at'=>'nullable|integer',
            'search.min_engine'=>'nullable|integer',
            'search.max_engine'=>'nullable|integer',
            'search.currency'=>'nullable|in:' . implode(',', Car::currencies()),

            'search.brand'=>'nullable|array',
            'search.brand.*'=>'nullable|integer',
            'search.car_model'=>'nullable|array',
            'search.car_model.*'=>'nullable|integer',

            'search.car_body'=>'nullable|array',
            'search.car_body.*'=>'nullable|integer',
            'search.gear_lever'=>'nullable|array',
            'search.gear_lever.*'=>'nullable|integer',
            'search.transmission'=>'nullable|array',
            'search.transmission.*'=>'nullable|integer',
            'search.fuel'=>'nullable|array',
            'search.fuel.*'=>'nullable|integer',
            'search.color'=>'nullable|array',
            'search.color.*'=>'nullable|integer',
            'search.city'=>'nullable|array',
            'search.city.*'=>'nullable|integer',
            'search.equipment'=>'nullable|array',
            'search.equipment.*'=>'nullable|integer',
        ];
    }
}
