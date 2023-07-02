@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card mb-4 border-5 border-primary">
                <div class="card-header d-flex align-items-center gap-1">
                    @if($image->user->image)
                    <img src="{{route('user.image', ['filename'=> $image->user->image ])}}" width="40" height="32" class="rounded-circle "  />
                    @else
                    <img src="{{route('user.image', ['filename'=> 'null.png' ])}}" width="30" height="30" class="rounded-circle "  />
                    @endif
                    <a class="nav-link" href="{{route('profile',['id'=> $image->user->id])}}">
                        {{$image->user->nickname}}        
                    </a>

                </div>

                    <div class="card-body p-0 ">
                        <img src="{{route('img', ['filename'=> $image->image_path ])}}"  class="img-fluid "  />
                        <div class="p-2">
                            <h1 class="h6">
                                {{$image->user->name }} / 
                                {{\Carbon\Carbon::now()->diffForHumans($image->created_at)}} 
                            </h1>
                            <p class="">
                                {{$image->description}}
                            </p>

                            <div class="d-flex gap-2 align-items-center m-1">
                                <div class="btn btn-outline-primary py-0 px-1 ">
    
                                    @if(count($image->likes->where('user_id', Auth::user()->id )))
                                    <button class="btn py-0 px-0 btn-like" data-id="{{$image->id}}" >
                                        ❤️
                                    </button>
                                    @else
                                    <button class="btn py-0  px-0 btn-dislike" data-id="{{$image->id}}" >
                                        🖤
                                    </button>
                                    @endif
                                    <span>
                                        {{count($image->likes)}}
                                    </span>
                                </div>

                                @if($image->user->id == Auth::user()->id)
                                <a href="{{route('img.edit', ['id'=> $image->id])}}" class="btn btn-primary p-0 px-1 ">Actualizar</a>
                                   

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger p-0 px-1" data-bs-toggle="modal" data-bs-target="#modalId">
                                  eliminar
                                </button>
                                

                                <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">¿Desea eliminar esta imagen?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                         
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <a href="{{route('img.delete',['id'=> $image->id])}}" class="btn btn-danger ">Eliminar</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <!-- Optional: Place to the bottom of scripts -->
                                <script>
                                    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                                
                                </script>
                                @endif
                                
                         </div>

                         <hr>


                         <div>
                            <form class="mb-3 p-2" method="POST" action="{{route('comment.save')}}" >
                                @csrf
                              <input type="hidden" name="image_id" value="{{$image->id}}" >
                              <textarea class="form-control mb-1 @error('content') is-invalid @enderror" name="content" ></textarea>
                              @error('content')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                              <button type="submit" class="btn btn-success">Enviar</button>
                            </form>
                            <hr>
                            <section class="px-2">
                                <h2>Comentarios ({{count($image->comments)}})</h2>
                                    @if(session('message'))
                                        <div class="alert alert-primary" role="alert">
                                        <strong>{{session('message')}}</strong> 
                                        </div>
                                        
                                    @endif
                                @foreach($image->comments->reverse() as $comment)
                                <div class="alert alert-secondary border-1 border-dark p-1" role="alert">
                                    <strong>{{$comment->user->nickname}} |  {{\Carbon\Carbon::now()->diffForHumans($image->created_at) }} :</strong> {{$comment->content}}

                                @if(Auth::user()->id == $comment->user_id)
                                    <a href="{{route('comment.delete', ['id'=> $comment->id])}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>

                                @endif
                                </div>
                                @endforeach
                                
                            </section>

                         </div>

                    </div>
            </div>
                
        </div>
    </div>
</div>
@endsection
