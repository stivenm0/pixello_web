@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 my-2 col-md-4"  >
            @if($user->image)
            <img src="{{route('user.image', ['filename'=> $user->image ])}}"  class="rounded-circle img-fluid"  />
            @else
            <img src="{{route('user.image', ['filename'=> 'null.png' ])}}" class="rounded-circle img-fluid "  />
            @endif
        </div>
        <div class="col-11 col-md-6 d-flex justify-content-center align-items-center flex-column">
            <h1>{{$user->name ." ". $user->surname}}  </h1>
            <h2>{{$user->nickname}}</h2>
            <h3>{{\Carbon\Carbon::now()->diffForHumans($user->created_at) }}</h3>
        </div>
        <hr>

        <div class="col-md-8 mt-5">
            @if(!$user->images->isEmpty())
                @foreach($user->images as $img)
                    @include('image.image',['image'=> $img])
                @endforeach
            @else
                <div class="alert text-center alert-primary" role="alert">
                    <strong>No Hay Fotos</strong> 
                </div>  
            @endif
        </div>
       
    </div>
</div>
@endsection
