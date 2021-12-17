@extends('layouts.app')

@section('content')
    
    <div class="search-area py-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    @include('inc.messages')
                    <div class="card card-dark bg-dark-full bg-gradient text-main bg-gradient">
                        <div class="card-body">
                            <h4 class="my-4">Ətraflı axtarış</h4>
                            <form action="{{route('search.index')}}" class="row" method="get">
                                
                                <div class="col-12 col-sm-6 mb-5">
                                    <label for="searchBrandAdvanced" class="form-label">Marka</label>
                                    <select name="brand[]" id="searchBrandAdvanced" class="custom-select" multiple>
                                        <option value="">Bütün Markalar</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}" >{{$brand->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                
                                <div class="col-12 col-sm-6 mb-5">
                                    <label for="searchCarModelAdvanced" class="form-label">Model</label>
                                    <select class="custom-select" name="car_model[]" id="searchCarModelAdvanced" multiple>
                                        <option value="">Bütün Modellər</option>
                                    </select>

                                </div>


                                <div class="col-12 col-sm-6 mb-5">
                                    <label for="searchCarBody" class="form-label">Ban növü</label>
                                    <select name="car_body[]" id="searchCarBody" class="custom-select" multiple>
                                        <option value="">Bütün Ban növləri</option>
                                        @foreach ($carBodies as $carBody)
                                            <option value="{{$carBody->id}}" >{{$carBody->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-12 col-sm-6 mb-5">
                                    <label for="searchColor" class="form-label">Rəng</label>
                                    <select name="color[]" id="searchColor" class="custom-select" multiple>
                                        <option value="">Bütün Rənglər</option>
                                        @foreach ($colors as $color)
                                            <option value="{{$color->id}}" >{{$color->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-12 col-sm-6 mb-5">
                                    <label class="form-label" for="searchCity">
                                        Şəhər
                                    </label>
                                    <select name="city[]" id="searchCity" class="custom-select" multiple>
                                        <option value="">Bütün Şəhərlər</option>
                                        @foreach ($cities as $city)
                                            <option value="{{$city->id}}" >{{$city->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-12 col-sm-6 mb-5">
                                    <label class="form-label" for="searchFuel">
                                        Yanacaq növü
                                    </label>
                                    <select name="fuel[]" id="searchFuel" class="custom-select" multiple>
                                        <option value="">Bütün Yanacaq Növləri</option>
                                        @foreach ($fuels as $fuel)
                                            <option value="{{$fuel->id}}" >{{$fuel->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                
                                <div class="col-12 col-sm-6 mb-5">
                                    <label class="form-label" for="">
                                        Yürüş, km
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">Min</span>
                                        <input type="text" name="min_distance" class="form-control" aria-label="">
                                        <span class="mr-1"></span>
                                        <span class="input-group-text">Max</span>
                                        <input type="text" name="max_distance" class="form-control" aria-label="">                                       
                                    </div>
                                </div>

                                

                                <div class="col-12 col-sm-6  mb-5">
                                    <label class="form-label" for="">
                                        Qiymət
                                    </label>
                                    <div class="input-group">       
                                        <span class="input-group-text">Min</span>
                                        <input type="text" name="min_price" class="form-control" aria-label="">
                                        <span class="mr-1"></span>
                                        <span class="input-group-text">Max</span>
                                        <input type="text" name="max_price" class="form-control" aria-label="">
                                        <span class="mr-1"></span>
                                        <select class="custom-select" name="currency" id="currency">
                                            <option value="AZN">AZN</option>
                                            <option value="USD">USD</option>
                                            <option value="EUR">EUR</option>
                                        </select>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="barter" type="checkbox" id="barter">
                                        <label class="custom-control-label" for="barter">
                                            Barter
                                        </label>
                                      </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="credit" type="checkbox" id="credit">
                                        <label class="custom-control-label" for="credit">
                                            Kreditdədir
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-6 mb-5">
                                    <label class="form-label" for="searchTransmission">
                                        Ötürücü
                                    </label>
                                    <select name="transmission[]" id="searchTransmission" class="custom-select" multiple>
                                        <option value="">Bütün Ötürücülər</option>
                                        @foreach ($transmissions as $transmission)
                                            <option value="{{$transmission->id}}" >{{$transmission->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                
                                <div class="col-12 col-sm-6 mb-5">
                                    <label class="form-label" for="searchGearLever">
                                        Sürət qutusu
                                    </label>
                                    <select name="gear_lever[]" id="searchGearLever" class="custom-select" multiple>
                                        <option value="">Bütün Sürət Qutuları</option>
                                        @foreach ($gearLevers as $gearLever)
                                            <option value="{{$gearLever->id}}" >{{$gearLever->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-12 col-sm-6 mb-5">
                                    <label class="form-label mr-2" for="">
                                        Buraxılış ili
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">Min</span>
                                        <input type="text" name="min_made_at" class="form-control" aria-label="">
                                        <span class="mr-1"></span>
                                        <span class="input-group-text">Max</span>
                                        <input type="text" name="max_made_at" class="form-control" aria-label="">   
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 mb-5">
                                    <label class="form-label mr-2" for="">
                                        Mühərrik həcmi, sm<sup>3</sup>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">Min</span>
                                        <select name="min_engine" class="custom-select" id="minEngine">
                                            <option value="">0</option>
                                            @foreach ($engines as $engine)
                                                <option value="{{$engine->volume}}">{{$engine->volume}}</option>
                                            @endforeach
                                        </select>
                                        <span class="mr-1"></span>
                                        <span class="input-group-text">Max</span>
                                        <select name="max_engine" class="custom-select" id="minEngine">
                                            <option value="">Bütün</option>
                                            @foreach ($engines as $engine)
                                                <option value="{{$engine->volume}}">{{$engine->volume}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-5">
                                    <h4>Avtomobilin təchizatı</h4>
                                    <div class="row">
                                        @foreach ($equipment as $item)
                                        <div class="col-12 col-md-3 mb-1">
                                            <div class="">
                                                <input class="" name="equipment[]" value="{{$item->id}}" type="checkbox" id="equipment-{{$item->id}}">  
                                                <label class="" for="equipment-{{$item->id}}">
                                                    {{$item->name}}
                                                </label>
                                                                          
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- <div class="col-12 mb-5">
                                    <h4>Axtarışın nəticələri</h4>
                                    <div class="row">      
                                        <div class="col-12 col-md-6 mb-4">

                                            <select name="sort_by]" id="sort_by" class="custom-select">
                                                <option value="date" selected>Tarixə görə</option>
                                                <option value="price_cheap">Əvvəlcə ucuz</option>
                                                <option value="price_expensive">Əvvəlcə bahalı</option>
                                                <option value="distance">Yürüş</option>
                                                <option value="made_at">Buraxılış ili</option>
                                            </select>

                                        </div>
                                    </div>
                                </div> --}}

  
                                <div class="col-12 mb-5">
                                    <button type="submit" class="btn btn-main">
                                        Axtar
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>

@endsection