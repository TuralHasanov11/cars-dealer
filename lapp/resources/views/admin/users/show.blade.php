@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 pb-2">

                {{-- <a href="{{url()->back()}}" class="btn btn-primary btn-lg">Geriyə</a> --}}

                <ul class="list-group">
                    <li class="list-group-item bg-main bg-gradient"><b>Ad: </b>{{$user->name}}</li>
                    <li class="list-group-item bg-main bg-gradient"><b>E-mail: </b>{{$user->email}}</li>
                    <li class="list-group-item bg-main bg-gradient"><b>Avtomobil sayı: </b>{{count($user->cars)}}</li>
                    <li class="list-group-item bg-main bg-gradient"><b>Avtomobillər: </b>
                        <ul class="list-group">
                            @foreach ($user->cars as $car)
                            <li class="list-group-item bg-main bg-gradient">
                                <a href="{{route('admin.showCar',['car'=>$car])}}" class="text-dark">
                                    {{$car->carModel->brand->name}} {{$car->carModel->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="list-group-item bg-main bg-gradient">
                        <form action="{{route('admin.destroyUser',['user'=>$user])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">İstifadəçini sil</button>
                        </form>
                    </li>
                </ul>
        
            </div>
        
        
          </div>
    </div>
@endsection

