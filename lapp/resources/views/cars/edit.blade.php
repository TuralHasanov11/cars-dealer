@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('inc.messages')

            <div class="card">
                <div class="card-header">Elana düzəliş et</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cars.update',['car'=>$car]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4 row">
                            <label for="price" class="col-md-4 col-form-label required text-md-right">Qiymət</label>

                            <div class="col-md-6">
                                <input id="price" type="number" min="500" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $car->price }}" required>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="currency" value="AZN" id="currency-1" {{ $car->currency === 'AZN' ? 'checked' : '' }}>
                                    
                                    <label class="form-check-label" for="currency-1">
                                        AZN
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="currency" value="USD" id="currency-2" {{ $car->currency === 'USD' ? 'checked' : '' }}>

                                    <label class="form-check-label" for="currency-2">
                                        USD
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="currency" value="EUR" id="currency-3" {{ $car->currency === 'EUR' ? 'checked' : '' }}>

                                    <label class="form-check-label" for="currency-3">
                                        EUR
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="barter" id="barter" {{ $car->barter ? 'checked' : '' }}>

                                    <label class="form-check-label" for="barter">
                                        Barter
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="credit" id="credit" {{ $car->credit ? 'checked' : '' }}>

                                    <label class="form-check-label" for="credit">
                                        Kreditdədir
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-4 row">
                            <label for="made_at" class="col-md-4 col-form-label required text-md-right">Buraxılış ili</label>

                            <div class="col-md-6">

                                <select name="made_at" id="made_at" class="form-control @error('made_at') is-invalid @enderror" required>
                                    <option value="">Buraxılış ili seçin</option>
                                    @for ($i = 2000; $i < 2020; $i++)
                                        <option value="{{$i}}" {{$car->made_at === $i ? 'selected' : null}}>
                                            {{$i}}
                                        </option>
                                    @endfor
                                </select>

                                @error('made_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="distance" class="col-md-4 col-form-label required text-md-right">Məsafə</label>

                            <div class="col-md-6">
                                <input id="distance" type="number" step="10000" min="0" class="form-control @error('distance') is-invalid @enderror" name="distance" value="{{ $car->distance }}" required>

                                @error('distance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="transmission" class="col-md-4 col-form-label required text-md-right">Ötürücü</label>

                            <div class="col-md-6">

                                <select name="transmission" id="transmission" class="form-control @error('transmission') is-invalid @enderror" required>
                                    <option value="">Ötürücü seçin</option>
                                    @foreach ($transmissions as $transmission)
                                        <option value="{{$transmission->id}}" {{$car->transmission->id === $transmission->id ? 'selected' : null}}>{{$transmission->name}}</option>
                                    @endforeach
                                </select>

                                @error('transmission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="gear_lever" class="col-md-4 col-form-label required text-md-right">Sürətlər qutusu</label>

                            <div class="col-md-6">

                                <select name="gear_lever" id="gear_lever" class="form-control @error('gear_lever') is-invalid @enderror" required>
                                    <option value="">Sürətlər qutusu seçin</option>
                                    @foreach ($gearLevers as $gearLever)
                                        <option value="{{$gearLever->id}}" {{$car->gearLever->id === $gearLever->id ? 'selected' : null}}>{{$gearLever->name}}</option>
                                    @endforeach
                                </select>

                                @error('gear_lever')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="city" class="col-md-4 col-form-label required text-md-right">Şəhər</label>

                            <div class="col-md-6">

                                <select name="city" id="city" class="form-control @error('city') is-invalid @enderror" required>
                                    <option value="">Şəhər seçin</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}" {{$car->city->id === $city->id ? 'selected' : null}}>{{$city->name}}</option>
                                    @endforeach
                                </select>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="car_body" class="col-md-4 col-form-label required text-md-right">Ban növü</label>

                            <div class="col-md-6">

                                <select name="car_body" id="car_body" class="form-control @error('car_body') is-invalid @enderror" required>
                                    <option value="">Ban növü seçin</option>
                                    @foreach ($carBodies as $carBody)
                                        <option value="{{$carBody->id}}" {{$car->carBody->id === $carBody->id ? 'selected' : null}}>{{$carBody->name}}</option>
                                    @endforeach
                                </select>

                                @error('car_body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="color" class="col-md-4 col-form-label required text-md-right">Rəng</label>

                            <div class="col-md-6">

                                <select name="color" id="color" class="form-control @error('color') is-invalid @enderror" required>
                                    <option value="">Rəng seçin</option>
                                    @foreach ($colors as $color)
                                        <option value="{{$color->id}}" {{$car->color->id === $color->id ? 'selected' : null}}>{{$color->name}}</option>
                                    @endforeach
                                </select>

                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="engine" class="col-md-4 col-form-label required text-md-right">Mühərrikin həcmi, sm<sup>3</sup> </label>

                            <div class="col-md-6">

                                <select name="engine" id="engine" class="form-control @error('engine') is-invalid @enderror" required>
                                    <option value="">Mühərrik həcmi seçin</option>
                                    @foreach ($engines as $engine)
                                        <option value="{{$engine->id}}" {{$car->engine->id === $engine->id ? 'selected' : null}}>{{$engine->volume}}</option>
                                    @endforeach
                                </select>

                                @error('engine')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="horsepower" class="col-md-4 col-form-label required text-md-right">Mühərrikin gücü, a.g.</label>

                            <div class="col-md-6">

                                <input id="horsepower" type="number" class="form-control @error('horsepower') is-invalid @enderror" name="horsepower" value="{{ $car->horsepower }}" required>

                                @error('horsepower')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="fuel" class="col-md-4 col-form-label required text-md-right">Yanacaq növü</label>

                            <div class="col-md-6">

                                <select name="fuel" id="fuel" class="form-control @error('fuel') is-invalid @enderror" required>
                                    <option value="">Yanacaq növü seçin</option>
                                    @foreach ($fuels as $fuel)
                                        <option value="{{$fuel->id}}" {{$car->fuel->id === $fuel->id ? 'selected' : null}}>{{$fuel->name}}</option>
                                    @endforeach
                                </select>

                                @error('fuel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="brand" class="col-md-4 col-form-label required text-md-right">Marka</label>

                            <div class="col-md-6">

                            <select name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" required >
                                    <option value="">Marka seçin</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}" {{$car->carModel->brand->id === $brand->id ? 'selected' : null}}>{{$brand->name}}</option>
                                    @endforeach
                                </select>

                                @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="car_model" class="col-md-4 col-form-label required text-md-right">Model</label>

                            <div class="col-md-6">

                                <select name="car_model" id="carModel" class="form-control @error('car_model') is-invalid @enderror" required >
                                   <option value="">Model Seçin</option>
                                   @foreach ($car->carModel->brand->carModels as $carModel)
                                       <option value="{{$carModel->id}}" {{$car->carModel->id === $carModel->id ? 'selected' : null}}>{{$carModel->name}}</option>
                                   @endforeach
                                </select>

                                @error('car_model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label class="col-md-4 col-form-label required text-md-right">Avtomobilin təchizatı</label>

                            <div class="col-md-6 offset-md-4">
                                
                                @foreach ($equipment as $item)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="equipment[]" value="{{$item->id}}" id="equipment-{{$item->id}}" 
                                            @if ($car->carEquipment)
                                               
                                                @foreach ($car->carEquipment as $carEquipment)
                                                    {{$carEquipment->id === $item->id ? 'checked' : null}}
                                                @endforeach
                                               
                                            @endif>
                                        <label class="form-check-label" for="equipment-{{$item->id}}">
                                            {{$item->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group mb-4 row">
                            <label for="body" class="col-md-4 col-form-label required text-md-right">Əlavə məlumat</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('body') is-invalid @enderror" name="body" cols="30" rows="10">{{ $car->body }}</textarea>
                                <small><em>Telefon nömrələri qeyd etmək qadağandır</em></small>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group mb-4 row">
                            <label class="col-md-4 col-form-label required text-md-right">Şəkillər</label>

                            <div class="col-md-6 border-secondary rounded">
                                <ul class="list-group">
                                    <li class="list-group-item">Minimum – 3 şəkil (ön, arxa və bütöv ön panelin görüntüsü mütləqdir).</li>
                                    <li class="list-group-item">Maksimum – 21 şəkil.</li>
                                </ul>

                                <div class="form-file">
                                    <input type="file" name="main_images[front]" class="form-file-input" id="customFile">
                                    <label class="form-file-label" for="customFile">
                                      <span class="form-file-text">Ön görünüş</span>
                                      <span class="form-file-button">Browse</span>
                                    </label>
                                  </div>

                                  <div class="form-file">
                                    <input type="file" name="main_images[back]" class="form-file-input" id="customFile">
                                    <label class="form-file-label" for="customFile">
                                      <span class="form-file-text">Arxa görünüş</span>
                                      <span class="form-file-button">Browse</span>
                                    </label>
                                  </div>

                                  <div class="form-file">
                                    <input type="file" name="main_images[front_panel]" class="form-file-input" id="customFile">
                                    <label class="form-file-label" for="customFile">
                                      <span class="form-file-text">Ön panel</span>
                                      <span class="form-file-button">Browse</span>
                                    </label>
                                  </div>

                                  <div class="form-file">
                                    <input type="file" name="additional_images[]" class="form-file-input" id="customFile" multiple>
                                    <label class="form-file-label" for="customFile">
                                      <span class="form-file-text">Əlavə şəkillər</span>
                                      <span class="form-file-button">Browse</span>
                                    </label>
                                  </div>
                            </div>
                        </div> --}}

                        <div class="form-group mb-4 row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Düzəliş et
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

