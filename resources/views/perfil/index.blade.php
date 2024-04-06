@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')

    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" enctype="multipart/form-data" action="{{route('perfil.store')}}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input 
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Tu Nombre de Usuario"    
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{auth()->user()->username }}"
                    >
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 
                        text-center"> {{ str_replace('username', 'nombre de usuario', $message) }} </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input 
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Tu Nombre de Usuario"    
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{auth()->user()->email }}"
                    >
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 
                        text-center"> {{ str_replace('email', 'email', $message) }} </p>
                    @enderror
                </div>

                <div class="border p-3">
                    <p class="text-gray-500 mb-2 font-bold">Opcional</p>
                    <div class="mb-5">
                        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password Actual</label>
                        <input 
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Password de Registro"    
                            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                        >
                    </div>
                    @if (session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 
                        text-center"> {{ session('mensaje') }} </p>
                     @endif
    
                    <div class="mb-5">
                        <label for="password_nuevo" class="mb-2 block uppercase text-gray-500 font-bold">Password nuevo</label>
                        <input 
                            type="password"
                            id="password_nuevo"
                            name="password_nuevo"
                            placeholder="Password Nuevo"    
                            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                        >
                    </div>
                </div>


                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                    <input 
                        type="file"
                        id="imagen"
                        name="imagen"  
                        class="border p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg,.jpeg,.png"
                    >
                </div>
                <input 
                type="submit" 
                value="Guardar Cambios"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full
                        p-3 text-white rounded-lg"
                >
            </form>
        </div>
    </div>
@endsection