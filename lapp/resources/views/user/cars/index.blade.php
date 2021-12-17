@extends('layouts.app')

@section('content')
    
<div class="cars-area py-5" id="cars">
    <h1 class="text-center text-main">Elanlarım</h1>
    <div class="container">
        <p style="border: 0.1em solid gray; border-radius:50%;"></p>
    </div>
    <div class="container py-3">
        <div class="row gap-3">
            @foreach ($cars as $car)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card bg-dark-full bg-gradient text-main border-0" style="height: 100%">
                        <div class="card-image-container">
                            <img class="card-image" src="/storage/images/cars/{{$car->id}}/{{$car->images[0]->url}}" alt="{{$car->carModel->brand->name}} {{$car->carModel->name}}">
                            <p class="car-info">
                                <span class="py-2 px-2 bg-main bg-gradient text-light mr-1 rounded">{{$car->price}} @switch($car->currency)
                                    @case('AZN')
                                        &#8380;
                                        @break
                                    @case('EUR')
                                        &#8364;
                                        @break
                                    @case('USD')
                                        &#36;
                                        @break
                                    @default
                                        
                                @endswitch </span>
                                @if ($car->barter)
                                    <span class="badge badge-success rounded-circle" data-toggle="tooltip" data-placement="top" title="Barter mümkündür">
                                        <svg width="1.75em" height="1.75em" viewBox="0 0 16 16" class="bi bi-arrow-repeat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                            <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                        </svg>
                                    </span>
                                @endif
                                @if ($car->credit)
                                    <span class="badge badge-warning rounded-circle" data-toggle="tooltip" data-placement="top" title="Kreditdədir">
                                        <svg width="1.75em" height="1.75em" viewBox="0 0 16 16" class="bi bi-percent" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                        </svg>
                                    </span>
                                @endif
                            </p>
                        </div>
                        
                        <div class="card-body border-0">
                            <h5 class="card-title overflow-ellipsis">{{$car->carModel->brand->name}} {{$car->carModel->name}}</h5>
                           
                            <p class="card-text">{{$car->made_at}} il &#183; {{$car->engineVolume()}}L &#183; {{$car->distance}} km</p>
                            <p class="card-text"><small>{{$car->city->name}}, {{$car->createdDateTime()}}</small></p>
                            <p class="card-text d-flex justify-content-between">
                                    @if (count($bookmarkedCars)>0 && $bookmarkedCars->where('id',$car->id)->first())
                                        <app-car-bookmark remove="{{true}}" url="{{route('cars.show',['car'=>$car->id])}}"></app-car-bookmark>
                                        @else
                                        <app-car-bookmark add="{{true}}" url="{{route('cars.show',['car'=>$car->id])}}"></app-car-bookmark>
                                    @endif
                                    <a href="{{route('cars.show',['car'=>$car->id])}}" class="btn btn-main">Ətraflı</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                @endforeach
            </div>
        </div>
    </div>

@endsection