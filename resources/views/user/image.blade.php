@if(Auth::user()->image)
<img src="{{route('user.image', ['filename'=> $img->user->image ])}}" width="40" height="32" class="rounded-circle "  />
@else
<img src="{{route('user.image', ['filename'=> 'null.png' ])}}" width="30" height="30" class="rounded-circle "  />
@endif