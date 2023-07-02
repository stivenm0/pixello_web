<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function config()
    {
        return view('user.config');
    }

    public function index(string $search = null){

        if($search){
            $users = User::where('nickname', 'LIKE', '%'.$search.'%')->orWhere('name', 'LIKE', '%'.$search.'%')->orderBy('id', 'desc')->simplePaginate();
            return view('user.users', ['users'=>$users]);
        }

        $users = User::orderBy('id', 'desc')->simplePaginate();
        return view('user.users', ['users'=>$users]);
    }

    public function update(Request $request){        
        $id = Auth::user()->id;
        

        $user = User::find($id);

       $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255', Rule::unique('users','nickname')->ignore($id, 'id')],
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users', 'email')->ignore($id, 'id')],
        ]);
        
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->nickname = $request->input('nickname');
        $user->email = $request->input('email');
                
        $image =$request->file('image');
        if($image){
            $image_up=  time(). $image->getClientOriginalName();

            Storage::disk("users")->put($image_up, File::get($image) );
            
            $user->image = $image_up;
        }
        
        
        $user->save();

        return redirect()->route('config')->with(['message' => 'Usuario Actualizado']);
    }


    public function getImage($filename)
    {
        $file =Storage::disk("users")->get($filename);
        return Response($file, 200);
    }

    public function profile(string $id){
        $user = User::find($id);
        
        return view('user.perfil', ['user'=> $user]);
    }
}
