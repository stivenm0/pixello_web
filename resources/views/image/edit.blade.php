@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>{{session('message')}}</strong> 
    </div>
    
        
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header  ">
                    Editar Imagen
                </div>

                <div class="card-body">
                    <form class="text-center" method="POST" action="{{ route('img.update') }}"  enctype="multipart/form-data">
                        @csrf

                        <input name="image_id" type="hidden" value="{{$image->id}}">
                        <img src="{{route('img', ['filename'=> $image->image_path])}}" class=" p-2" width="150" alt="imagen">

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image"   >

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" cols="30" rows="3" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $image->description}}"  ></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Editar
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