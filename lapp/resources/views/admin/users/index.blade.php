@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        
            <table class="table table-dark table-striped text-main table-hover">
                <thead>
                    <tr>
                      <th scope="col">#ID</th>
                      <th scope="col">İstifadəçi adı</th>
                      <th scope="col">E-mail<i></i></th>
                      <th scope="col">Elan sayı</th>
                      <th scope="col">Əməliyyatlar</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->cars_count}}</td>
                            <td>
                                <a href="{{route('admin.showUser', ['user'=>$user])}}" class="btn btn-primary">Ətraflı</a>
                            </td>
                        </tr>                  
                    @endforeach

                  </tbody>
            </table>

            {{$users->links()}}
        </div>
    </div>

    
@endsection

