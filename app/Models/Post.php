<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {

        return $this->belongsTo(User::class) // Establece la relación "belongsTo" con el modelo User
        ->select(['name', 'username']); // Selecciona solo las columnas 'name' y 'username' de la tabla User
    
    }
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
    public function likes(){

        return $this->hasMany(Like::class);
    }
    public function checkLike(User $user){
        return $this->likes->contains('user_id',$user->id);
    }
}
