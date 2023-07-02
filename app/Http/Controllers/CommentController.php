<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'content'=>'required|max:255'
        ]);
        
        $user_id = Auth::user()->id;
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new Comment();

        $comment->user_id = $user_id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save(); 
        
        return redirect()->route('img.details',['id'=>$image_id]);
    }

    public function delete(string $id)
    {
        $comment = Comment::find($id);
        $user_id = Auth::user()->id;

        $image = $comment->image_id;

        if( $user_id == $comment->user_id){
            $comment->delete();

            return redirect()->route('img.details', ['id'=> $image])->with(['message'=>'Comentario Eliminado']);
        }

        return redirect()->route('img.details', ['id'=> $image])->with(['message'=>'Comentario No Eliminado']);
    }
}
