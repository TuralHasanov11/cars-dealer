@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        
            <table class="table table-dark table-striped text-main table-hover">
                <thead>
                    <tr>
                      <th scope="col">#ID</th>
                      <th scope="col">Avtomobil</th>
                      <th scope="col">İstifadəçi<i></i></th>
                      <th scope="col">Elanın tarixi</th>
                      <th scope="col">Əməliyyatlar</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($cars as $car)
                        <tr>
                            <th scope="row">{{$car->id}}</th>
                            <td>{{$car->carModel->brand->name}} {{$car->carModel->name}}</td>
                            <td><a class="link-main" href="{{route('admin.showUser',['user'=>$car->user])}}">{{$car->user->name}}</a></td>
                            <td>{{$car->created_at}}</td>
                            <td>
                                <a href="{{route('admin.showCar', ['car'=>$car])}}" class="btn btn-primary">Göstər</a>
                            </td>
                        </tr>                  
                    @endforeach

                  </tbody>
            </table>

            {{$cars->links()}}
        </div>
    </div>
@endsection

