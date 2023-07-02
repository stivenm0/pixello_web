@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8  gap-5">
                @if(!$images->isEmpty())
                    @foreach($images as $img)
                    @include('image.image')
                    @endforeach
                    {{$images->links()}}
                @else
                    <div class="alert text-center alert-primary" role="alert">
                        <strong>No Hay Fotos</strong> 
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
