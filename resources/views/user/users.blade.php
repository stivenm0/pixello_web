@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="text-center">USUARIOS</h1>
    <form class="mb-3 d-flex" method="GET" action="{{route('users')}}" id="buscador">
      <input type="text"  id="search" class="form-control" placeholder="" aria-describedby="helpId">
      <input type="submit" class="btn btn-success" value="buscar">
    </form>

    @foreach($users as $user)
        <div class="row justify-content-center opacity-3 bg-white">
            <div class="col-5 my-2 col-md-2"  >
                @if($user->image)
                <img src="{{route('user.image', ['filename'=> $user->image ])}}"  class="rounded-circle img-fluid"  />
                @else
                <img src="{{route('user.image', ['filename'=> 'null.png' ])}}" class="rounded-circle img-fluid "  />
                @endif
            </div>
            <div class="col-11 col-md-6 d-flex justify-content-center align-items-center flex-column ">
                <h2>{{$user->name ." ". $user->surname}}  </h2>
                <h3>{{$user->nickname}}</h3>
                <h4>{{\Carbon\Carbon::now()->diffForHumans($user->created_at) }}</h4>
                <a href="{{route('profile', ['id'=>$user->id])}}" class="btn btn-primary my-2">perfil</a>
            </div>
            <hr>
       
        </div>
    @endforeach
    
</div>
@endsection