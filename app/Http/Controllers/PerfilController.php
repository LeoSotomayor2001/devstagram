<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    
    public function index(){
        
        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username'  => Str::slug( $request->username)]);

        $request->validate([
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'],
            'email'=> ['required','unique:users,email,'.auth()->user()->id,'max:60'],
            
        ]);

        if($request->imagen){
            $imagen=$request->file('imagen');
            
            $nombreImagen=Str::uuid() . '.' . $imagen->extension();
            $imagenServidor=Image::make($imagen);
            $imagenServidor->fit(1000,1000);
            
            if(!is_dir(public_path('perfiles'))){
                mkdir('perfiles');
            }
            $imagenPath=public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }   

        //Guardar cambios
        $usuario=User::find(auth()->user()->id);
        $usuario->username=$request->username;
        $usuario->email=$request->email;
        $usuario->imagen=$nombreImagen ?? auth()->user()->imagen ?? '';

        //Verifica si el campo password tiene algo escrito
        if ($request->password) {
            //Compara la contraseña introducida con la que esta guardada en la BD
            if (!Hash::check($request->password, auth()->user()->password)) {
                return back()->with('mensaje', 'La contraseña actual es incorrecta.');
            }
            else{
                //Verifica si hay algo escrito en el campo password_nuevo
               if($request->password_nuevo){
                    //Guarda la nueva contraseña
                    $usuario->password= Hash::make($request->password_nuevo);
               }
               else{
                    return back()->with('mensaje', 'La contraseña nueva es obligatoria.');
               }
            }
        }
        
        $usuario->save();
        //Redireccionar
        return redirect()->route('posts.index',$usuario->username);
    }
}
