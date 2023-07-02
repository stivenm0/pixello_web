<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('image.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image'=>['required', 'mimes:jpeg,png,jpg'],
            'description'=> ['required','string', 'max:200']   
        ]);

        $img = $request->file('image');

        $image = new Image();

        $image->user_id = Auth::user()->id;

        $image_up=  time(). $img->getClientOriginalName();

        Storage::disk("images")->put($image_up, File::get($img) );

        $image->image_path = $image_up;

        $image->description = $request->input('description');

        $image->save();

        
        return redirect()->route('image.new')->with(['message' => 'Imagen Agregada']);
        
    }

    public function getImage($filename){
        $file =Storage::disk("images")->get($filename);
        return Response($file, 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = Image::find($id);

        return view('image.details', ['image' => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = Image::find($id);
        $user_id = Auth::user()->id;
        if($image->user->id == $user_id){
            return view('image.edit', ['image'=> $image]);
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'image'=>['mimes:jpeg,png,jpg'],
            'description'=> ['required','string', 'max:255']   
        ]);

        $img = $request->file('image');

        $img_id = $request->input('image_id');

        $image = Image::find($img_id);

        if($image->image_path){
            if($img){
                Storage::disk('images')->delete($image->image_path);
                $image_up=  time(). $img->getClientOriginalName();
    
                Storage::disk("images")->put($image_up, File::get($img) );
    
                $image->image_path = $image_up;
            }
           

            $image->description = $request->input('description');

            $image->update();

            return redirect()->route('img.edit', ['id'=> $image->id] )->with(['message' => 'Imagen Agregada']);

        }
        return redirect()->route('img.edit', ['id'=> $image->id] )->with(['message' => 'Imagen No Editada']);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Image::find($id);
        $user_id = Auth::user()->id;
        if($user_id == $image->user_id){
            Storage::disk('images')->delete($image->image_path);
            $image->delete();

            $message = ['message'=> 'imagen eliminada'];

        }else{
            $message = ['message'=> 'imagen no eliminada'];
        }

        return redirect()->route('home')->with($message);
    }
}
