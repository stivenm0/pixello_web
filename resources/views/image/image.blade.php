<div class="card mb-4 border-1 border-primary">
    <div class="card-header d-flex gap-1 align-items-center">

        @if($img->user->image)
        <img src="{{route('user.image', ['filename'=> $img->user->image ])}}" width="40" height="32" class="rounded-circle "  />
        @else
        <img src="{{route('user.image', ['filename'=> 'null.png' ])}}" width="30" height="30" class="rounded-circle "  />
        @endif
        <a class="nav-link" href="{{route('profile',['id'=> $img->user->id])}}">
            {{$img->user->nickname}}        
        </a>

    </div>

        <div class="card-body p-0 ">
            <img src="{{route('img', ['filename'=> $img->image_path ])}}"  class="img-fluid "  />
            <p class="p-1">
                {{$img->description}}
            </p>

            <div class="d-flex gap-2 align-items-center m-1">
                <div class="btn btn-outline-primary py-0 px-1 ">

                    @if(count($img->likes->where('user_id', Auth::user()->id )))
                    <button class="btn py-0 px-0 btn-like" data-id="{{$img->id}}" >
                        ❤️
                    </button>
                    @else
                    <button class="btn py-0  px-0 btn-dislike" data-id="{{$img->id}}" >
                        🖤
                    </button>
                    @endif
                    <span>
                        {{count($img->likes)}}
                    </span>
                </div>

                <button type="button" class="btn btn-primary p-0 px-1">comentarios  ({{count($img->comments)}})</button>
                <a class="bg-warning rounded-pill " href="{{route('img.details' ,['id'=> $img->id])}}" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
            </div>
        </div>
</div>