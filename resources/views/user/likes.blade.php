@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(!$likes->isEmpty())
                @foreach($likes as $like)
                @include('image.image',['img'=> $like->image])
                @endforeach
                {{$likes->links()}}
             @else
                <div class="alert text-center alert-primary" role="alert">
                    <strong>No Hay Fotos</strong> 
                </div>             

            @endif
           
            
        </div>
    </div>
</div>
@endsection
