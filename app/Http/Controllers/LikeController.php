<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(string $image_id){

        $user_id = Auth::user()->id;
        $isLike = Like::where('image_id', $image_id)->where('user_id', $user_id)->count();
        
        if($isLike == 0){
            $like = new Like();
            $like->user_id = $user_id;
            $like->image_id = $image_id;
            $like->save();
        }

    }

    public function dislike(string $image_id){

        $user_id = Auth::user()->id;
        $like = Like::where('image_id', $image_id)->where('user_id', $user_id);

        if($like ){
            $like->delete();

        }

    }

    public function likes(){
        $likes = Like::orderBy('id' ,'desc')->where('user_id', Auth::user()->id)->simplePaginate();

        return view('user.likes', ['likes'=>$likes]);
    }
}
