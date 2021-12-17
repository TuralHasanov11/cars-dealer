@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 bg-dark-full bg-gradient pb-2">
        
              <article class="blog-post">

                <div class="row my-2 bg-dark-full bg-gradient">
                    <div class="col-12 col-md-6 px-1">
                        <div class="car-image-container">
                            <img class="car-image" src="{{asset($car->images->where('type','front')->first()->url)}}" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 px-1">
                        <app-car-images car="{{$car->id}}" :images='{{json_encode($car->images->whereIn("type",["back","front_panel","additional"]))}}'></app-car-images>
                    </div>
                </div>

                

                <h2 class="blog-post-title text-main">{{$car->carModel->brand->name}} {{$car->carModel->name}}, {{$car->made_at}} il &#183; {{$car->engineVolume()}}L &#183; {{$car->distance}} km</h2>
                

                <div class="row my-3 justify-content-between">
                   <div class="col-4">
                        <div class="px-3 py-3 bg-main ">{{$car->price}} @switch($car->currency)
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
                                
                        @endswitch</div> 
                    </div>
                   <div class="col-4 text-light">
                     {{$car->user->name}}
                   </div>
                   <div class="col-4 text-light">
                        <p>Yeniləndi : {{$car->updatedDateTime()}}</p>
                        {{-- <p>Baxış sayı : </p> --}}
                  </div>
                </div>
                <div class="container">
                    <p style="border: 0.05em solid gray; border-radius:50%;"></p>
                </div>
                <div id="carInfo" class="row">
                    <div class="col-12 col-md-6 car-properties">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Şəhər</b></div>
                                    <div class="col-6">{{$car->city->name}}</div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Marka</b></div>
                                    <div class="col-6"><a class="text-body" href="{{route('search.index', ['search[brand]'=>[$car->carModel->brand->id]])}}">{{$car->carModel->brand->name}}</a> </div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Model</b></div>
                                    <div class="col-6"><a class="text-body" href="{{route('search.index', ['search[brand]'=>[$car->carModel->id], 'search[car_model]'=>[$car->carModel->id]])}}">{{$car->carModel->name}}</a></div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Buraxılış ili</b></div>
                                    <div class="col-6"><a class="text-body" href="{{route('search.index', ['search[brand]'=>[$car->carModel->id], 'search[car_model]'=>[$car->carModel->id], 'search[made__at]'=>$car->made_at])}}">{{$car->made_at}}</a></div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Ban növü</b></div>
                                    <div class="col-6">{{$car->carBody->name}}</div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Rəng</b></div>
                                    <div class="col-6">{{$car->color->name}}</div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Mühərrik</b></div>
                                    <div class="col-6">{{$car->engineVolume()}} L</div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Mühərrikin gücü</b></div>
                                    <div class="col-6">{{$car->horsepower}} a.g.</div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Yanacaq növü</b></div>
                                    <div class="col-6">{{$car->fuel->name}}</div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Yürüş</b></div>
                                    <div class="col-6">{{$car->distance}} km</div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Sürətlər qutusu</b></div>
                                    <div class="col-6">{{$car->transmission->name}}</div>
                                </div>
                            </li>
                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Ötürücü</b></div>
                                    <div class="col-6">{{$car->gearLever->name}}</div>
                                </div>
                            </li>

                            {{-- Yeni block --}}

                            <li class="list-group-item bg-main bg-gradient">
                                <div class="row justify-content-between">
                                    <div class="col-6"><b>Qiymət</b></div>
                                    <div class="col-6">
                                        <h5 class="text-dark">{{$car->price}} @switch($car->currency)
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
                                                
                                        @endswitch</h5>
                                        @if ($car->barter)
                                            <p>Barter mümkündür</p>
                                        @endif
                                        @if ($car->credit)
                                            <p>Kreditdədir</p>
                                        @endif
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-12 col-md-6 car-description text-main">
                        <ul style="line-height: 2;">
                            @foreach ($car->carEquipment as $equipment)
                                <li>{{$equipment->name}}</li>
                            @endforeach
                        </ul>
                        <div class="container">
                            <p style="border: 0.01em solid rgb(70, 70, 70); border-radius:50%;"></p>
                        </div>
                        <p id="carAdditionalInfo" class="container text-light">
                            {{$car->body}}
                        </p>
                        <div class="container">
                            <p style="border: 0.01em solid rgb(70, 69, 69); border-radius:50%;"></p>
                        </div>
                        <nav class="blog-pagination" aria-label="Pagination">

                            @if (count($bookmarkedCars)>0 && $bookmarkedCars->where('id',$car->id)->first())
                                <app-car-bookmark :car-single="{{'true'}}" remove="{{true}}" url="{{route('cars.show',['car'=>$car->id])}}"></app-car-bookmark >
                                @else
                                <app-car-bookmark :car-single="{{'true'}}" add="{{true}}" url="{{route('cars.show',['car'=>$car->id])}}"></app-car-bookmark >
                            @endif
                                
                        

                           @can('update', $car)
                            <a class="m-2 btn btn-outline-info" href="{{route('cars.edit', ['car'=>$car])}}">
                                <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-pencil-square mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                                Düzəliş et
                            </a>
                           @endcan
                            @can('delete', $car)
                                <form action="{{route('cars.destroy', ['car'=>$car])}}" method="post" class="m-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"tabindex="-1">
                                        <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-trash mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                        Elanı sil
                                    </button>
                                </form>
                            @endcan
                        </nav>
                    </div>
                </div>
            </article>
        
            </div>
        
        
          </div>
    </div>
@endsection

